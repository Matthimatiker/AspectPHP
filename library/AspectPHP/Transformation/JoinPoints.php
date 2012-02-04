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
     * The tokens of the source code that is currently processed.
     *
     * @var array(array(integer=>string|integer)|string)
     */
    protected $tokens = array();
    
    /**
     * The analyzer that is currently used to inspect the tokens.
     *
     * @var AspectPHP_Code_TokenAnalyzer
     */
    protected $analyzer = null;
    
    /**
     * Transforms the source code.
     *
     * @param string $source
     * @return string The transformed code.
     */
    public function transform($source) {
        // TODO: extract token analyzer class
        $this->tokens    = token_get_all($source);
        $this->analyzer  = new AspectPHP_Code_TokenAnalyzer($this->tokens);
        $injectionPoints = array();
        
        $classToken = $this->analyzer->findNext(T_CLASS, 0);
        if( $classToken === -1 ) {
            // No class found.
            return $source;
        }
        $index = $classToken;
        while( ($index = $this->analyzer->findNext(T_FUNCTION, $index)) !== -1 ) {
            // We found a "function" keyword at position $index.
            $bodyStart = $this->findBody($index);
            if( $bodyStart === -1 ) {
                // No body, might be an abstract method.
                continue;
            }
            $docComment   = $this->findDocBlock($index);
            $visibility   = $this->findMethodVisibility($index);
            $name         = $this->findMethodName($index);
            $originalName = $this->tokens[$name][1];
            $newName      = '_aspectPHP' . $originalName;
            $context      = ($this->isStatic($index)) ? '__CLASS__' : '$this';
            $signature    = $this->between($docComment, $bodyStart - 1);
            
            $injectionPoints[] = $this->buildInjectionPoint($signature, $newName, $context);
            
            // Rename the original method...
            $this->tokens[$name][1]       = $newName;
            // ... and reduce its visibility.
            $this->tokens[$visibility][0] = T_PRIVATE;
            $this->tokens[$visibility][1] = 'private';
            
            // Replace __METHOD__ constants.
            $methodConstants = $this->findAll(T_METHOD_C, $index);
            foreach( $methodConstants as $constantIndex ) {
                $this->tokens[$constantIndex][0] = T_STRING;
                $this->tokens[$constantIndex][1] = "__CLASS__ . '::{$originalName}'";
            }

            // Replace __FUNCTION__ constants.
            $functionConstants = $this->findAll(T_FUNC_C, $index);
            foreach( $functionConstants as $constantIndex ) {
                $this->tokens[$constantIndex][0] = T_STRING;
                $this->tokens[$constantIndex][1] = "'{$originalName}'";
            }
        }
        
        $body = $this->findBody($classToken);
        $end  = $this->analyzer->findMatchingBrace($body);
        // Inject method that handles method calls.
        $injectionPoints[] = $this->getCode('_aspectPHPInternalHandleCall');
        // Inject new methods at the end of the class body.
        $injectedCode = implode(PHP_EOL, $injectionPoints);
        $source = $this->between(0, $end - 1) . $injectedCode . $this->between($end, count($this->tokens) - 1);
        
        return $source;
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
        $end     = $this->analyzer->findMatchingBrace($start);
        return $this->analyzer->findAllBetween($type, $start, $end);
    }
    
    /**
     * Checks if the function at position $functionIndex is static.
     *
     * @param integer $functionIndex
     * @return boolean True if the function is static, false otherwise.
     */
    protected function isStatic($functionIndex) {
        return $this->analyzer->findPrevious(T_STATIC, $functionIndex, array(T_DOC_COMMENT, ';', '{', '}')) !== -1;
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
            if( is_string($this->tokens[$i]) ) {
                $code .= $this->tokens[$i];
            } else {
                $code .= $this->tokens[$i][1];
            }
        }
        return $code;
    }
    
    /**
     * Searches between $start and $end for a token of the given type
     * and returns its index.
     *
     * Returns -1 if the token was not found.
     *
     * Example:
     * <code>
     * $index = $this->findBetween(10, 25, T_PUBLIC);
     * </code>
     *
     * @param integer $start
     * @param integer $end
     * @param integer $type
     * @return integer
     */
    protected function findBetween($start, $end, $type) {
        for( $i = $start; $i <= $end; $i++ ) {
            if( is_array($this->tokens[$i]) && $this->tokens[$i][0] === $type) {
                return $i;
            }
        }
        return -1;
    }
    
    /**
     * Returns the index of the token that contains the name of the
     * method that is declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findMethodName($functionIndex) {
        return $this->analyzer->findNext(T_STRING, $functionIndex);
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
        return $this->analyzer->findPrevious($visibilities, $functionIndex, array('{', '}', ';'));
    }
    
    /**
     * Returns the index of the doc block that belongs to the method that is
     * declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findDocBlock($functionIndex) {
        return $this->analyzer->findPrevious(T_DOC_COMMENT, $functionIndex, array('{', '}', ';'));
    }
    
    /**
     * Returns the index of the next "{" token that starts a body.
     *
     * @param integer $index
     * @return integer
     */
    protected function findBody($index) {
        return $this->analyzer->findNext('{', $index, array(';'));
    }
    
    /**
     * Returns the index of the brace that close the brace at index $braceIndex.
     *
     * @param integer $braceIndex
     */
    protected function findClosingBrace($braceIndex) {
        $closingBraces = array(
            '(' => ')',
            '{' => '}'
        );
        $openingBrace = $this->tokens[$braceIndex];
        $closingBrace = $closingBraces[$openingBrace];
        
        $braceCount     = 1;
        $numberOfTokens = count($this->tokens);
        for( $i = $braceIndex + 1; $numberOfTokens; $i++ ) {
            if( !is_string($this->tokens[$i]) ) {
                continue;
            }
            if( $this->tokens[$i] === $openingBrace ) {
                $braceCount++;
            } elseif( $this->tokens[$i] === $closingBrace ) {
                $braceCount--;
                if ($braceCount === 0) {
                    return $i;
                }
            }
        }
        return -1;
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