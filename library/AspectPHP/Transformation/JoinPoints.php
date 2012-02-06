<?php

/**
 * AspectPHP_Transformation_JoinPoints
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */

/**
 * Transformation class that adds injection points to the given source code.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */
class AspectPHP_Transformation_JoinPoints {
    
    /**
     * The analyzer that is currently used to inspect the tokens.
     *
     * @var AspectPHP_Code_TokenEditor
     */
    protected $editor = null;
    
    /**
     * Transforms the source code.
     *
     * @param string $source
     * @return string The transformed code.
     */
    public function transform($source) {
        $this->editor = new AspectPHP_Code_TokenEditor($source);
        
        $classToken = $this->editor->findNext(T_CLASS, 0);
        if( $classToken === -1 ) {
            // No class found.
            return $source;
        }
        $body = $this->findBody($classToken);
        $classEnd = $this->editor->findMatchingBrace($body);
        
        $index = $classToken;
        while( ($index = $this->editor->findNext(T_FUNCTION, $index)) !== -1 ) {
            // We found a "function" keyword at position $index.
            $bodyStart = $this->findBody($index);
            if( $bodyStart === -1 ) {
                // No body, might be an abstract method.
                continue;
            }
            $docComment   = $this->findDocBlock($index);
            $visibility   = $this->findMethodVisibility($index);
            $name         = $this->findMethodName($index);
            $originalName = $this->editor[$name][1];
            $newName      = '_aspectPHP' . $originalName;
            $context      = ($this->isStatic($index)) ? '__CLASS__' : '$this';
            $signature    = $this->between($docComment, $bodyStart - 1);
            
            $injectionPoint = $this->buildInjectionPoint($signature, $newName, $context);
            $this->editor->insertBefore($classEnd, array($injectionPoint));
            
            // Rename the original method...
            $nameToken    = $this->editor[$name];
            $nameToken[1] = $newName;
            $this->editor->replace($name, $nameToken);
            
            // ... and reduce its visibility.
            if( $visibility === -1 ) {
                // Visibility was not defined explicity.
                $visibilityToken = array(
                    T_PRIVATE,
                    'private',
                    0
                );
                $this->editor->insertBefore($index, array($visibility));
            } else {
                $visibilityToken = $this->editor[$visibility];
                $visibilityToken[0] = T_PRIVATE;
                $visibilityToken[1] = 'private';
                $this->editor->replace($visibility, $visibilityToken);
            }
            
            // Replace __METHOD__ constants.
            $methodConstants = $this->findAll(T_METHOD_C, $index);
            foreach( $methodConstants as $constantIndex ) {
                $constantToken    = $this->editor[$constantIndex];
                $constantToken[0] = T_STRING;
                $constantToken[1] = "__CLASS__ . '::{$originalName}'";
                $this->editor->replace($constantIndex, $constantToken);
            }

            // Replace __FUNCTION__ constants.
            $functionConstants = $this->findAll(T_FUNC_C, $index);
            foreach( $functionConstants as $constantIndex ) {
                $constantToken    = $this->editor[$constantIndex];
                $constantToken[0] = T_STRING;
                $constantToken[1] = "'{$originalName}'";
                $this->editor->replace($constantIndex, $constantToken);
            }
        }
        
        $this->editor->insertBefore($classEnd, array($this->getCode('_aspectPHPInternalHandleCall')));
        
        $this->editor->commit();
        
        return (string)$this->editor;
    }
    
    /**
     * Finds all tokens of the given type in the body of the provided function.
     *
     * @param integer|string $type
     * @param integer $functionIndex
     * @return array(integer) The indexes of the matches.
     */
    protected function findAll($type, $functionIndex) {
        $matches = array();
        $start   = $this->findBody($functionIndex);
        $end     = $this->editor->findMatchingBrace($start);
        return $this->editor->findAllBetween($type, $start, $end);
    }
    
    /**
     * Checks if the function at position $functionIndex is static.
     *
     * @param integer $functionIndex
     * @return boolean True if the function is static, false otherwise.
     */
    protected function isStatic($functionIndex) {
        return $this->editor->findPrevious(T_STATIC, $functionIndex, array(T_DOC_COMMENT, ';', '{', '}')) !== -1;
    }
    
    /**
     * Builds an injection point.
     *
     * @param string $signature The method signature, including the doc comment.
     * @param string $callee Name of the method that will be called.
     * @param string $context The method context. For example $this or __CLASS__.
     * @return string The code of the generated injection point method.
     */
    protected function buildInjectionPoint($signature, $callee, $context) {
        $template = '    %1$s'                                                                                . PHP_EOL
                  . '    {'                                                                                   . PHP_EOL
                  . '        $args = func_get_args();'                                                        . PHP_EOL
                  . '        return self::_aspectPHPInternalHandleCall(__FUNCTION__, \'%3$s\', %2$s, $args);' . PHP_EOL
                  . '    }'                                                                                   . PHP_EOL;
        return sprintf($template, $signature, $context, $callee);
    }
    
    /**
     * Returns the source code of the given method including its doc block.
     *
     * Example:
     * <code>
     * $code = $this->getCode('buildInjectionPoint');
     * </code>
     *
     * @todo move to custom class
     * @todo introduce caching
     *
     * @param string $name The method name.
     * @return string
     */
    protected function getCode($name) {
        $method       = new ReflectionMethod(__CLASS__, $name);
        $docBlock     = $method->getDocComment();
        $fullSource   = file($method->getFileName());
        $linesOfCode  = $method->getEndLine() - $method->getStartLine() + 1;
        $methodSource = array_slice($fullSource, $method->getStartLine() - 1, $linesOfCode);
        $methodSource = implode('', $methodSource);
        return '    ' . $docBlock . PHP_EOL . $methodSource;
    }
    
    /**
     * Merges the tokens between $start and $end (inclusive) and
     * return the code as string.
     *
     * @param integer $start
     * @param integer $end
     * @return string
     */
    protected function between($start, $end) {
        $code = '';
        for( $i = $start; $i <= $end; $i++) {
            if( is_string($this->editor[$i]) ) {
                $code .= $this->editor[$i];
            } else {
                $code .= $this->editor[$i][1];
            }
        }
        return $code;
    }
    
    /**
     * Returns the index of the token that contains the name of the
     * method that is declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findMethodName($functionIndex) {
        return $this->editor->findNext(T_STRING, $functionIndex);
    }
    
    /**
     * Returns the index of the token that contains the visibility of the
     * method that is declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findMethodVisibility($functionIndex) {
        $visibilities = array(
            T_PUBLIC,
            T_PROTECTED,
            T_PRIVATE
        );
        return $this->editor->findPrevious($visibilities, $functionIndex, array('{', '}', ';'));
    }
    
    /**
     * Returns the index of the doc block that belongs to the method that is
     * declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findDocBlock($functionIndex) {
        return $this->editor->findPrevious(T_DOC_COMMENT, $functionIndex, array('{', '}', ';'));
    }
    
    /**
     * Returns the index of the next "{" token that starts a body.
     *
     * @param integer $index
     * @return integer
     */
    protected function findBody($index) {
        return $this->editor->findNext('{', $index, array(';'));
    }

    /**
     * Handles method calls.
     *
     * Contains logic regarding the aspect and join point handling.
     *
     * This method is injected into all compiled classes. Otherwise it
     * would not be possible to forward to its private methods.
     *
     * @param string $method The name of the called method.
     * @param string $compiledMethod The name of the method that will be called internally.
     * @param object|string $context The context of the method call.
     * @param array(mixed) $args The method arguments.
     * @return mixed
     * @throws Exception If the original method or a join point throws an exception.
     */
    private static function _aspectPHPInternalHandleCall($method, $compiledMethod, $context, $args) {
        if( AspectPHP_Container::hasManager() ) {
            $aspects = AspectPHP_Container::getManager()->getAspectsFor(__CLASS__ . '::' . $method);
        } else {
            $aspects = array();
        }
        if( count($aspects) === 0 ) {
            return call_user_func_array(array($context, $compiledMethod), $args);
        }
        $joinPoint = new AspectPHP_JoinPoint($method, $context);
        $joinPoint->setArguments($args);
        foreach( $aspects as $aspect ) {
            /* @var $aspect AspectPHP_Aspect */
            $aspect->before($joinPoint);
        }
        try {
            $returnValue = call_user_func_array(array($context, $compiledMethod), $args);
            $joinPoint->setReturnValue($returnValue);
            foreach( $aspects as $aspect ) {
                /* @var $aspect AspectPHP_Aspect */
                $aspect->afterReturning($joinPoint);
            }
            return $joinPoint->getReturnValue();
        } catch(Exception $e) {
            $joinPoint->setException($e);
            foreach( $aspects as $aspect ) {
                /* @var $aspect AspectPHP_Aspect */
                $aspect->afterThrowing($joinPoint);
            }
            throw $e;
        }
    }
    
}

?>