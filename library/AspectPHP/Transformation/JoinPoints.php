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
     * Transforms the source code.
     *
     * @param string $source
     * @return string The transformed code.
     */
    public function transform($source) {
        // TODO: extract token analyzer class
        $this->tokens    = token_get_all($source);
        $injectionPoints = array();
        $classToken      = -1;
        $originalName    = null;
        foreach( $this->tokens as $index => $token ) {
            /* @var array(integer=>string|integer)|string */
            if( is_string($token) ) {
                continue;
            }
            if( $token[0] === T_CLASS ) {
                $classToken = $index;
            } elseif( $classToken !== -1 && $token[0] === T_FUNCTION ) {
                $docComment   = $this->findDocBlock($index);
                $bodyStart    = $this->findBody($index);
                $visibility   = $this->findMethodVisibility($index);
                $name         = $this->findMethodName($index);
                $originalName = $this->tokens[$name][1];
                $newName      = '_aspectPHP' . $originalName;
                $context      = ($this->findBetween($docComment, $bodyStart, T_STATIC) === -1) ? '$this' : '__CLASS__';
                $signature    = $this->between($docComment, $bodyStart - 1);
                
                $injectionPoints[] = $this->buildInjectionPoint($signature, $newName, $context);
                
                // Rename the original method and reduce the visibility.
                $this->tokens[$name][1]       = $newName;
                $this->tokens[$visibility][0] = T_PRIVATE;
                $this->tokens[$visibility][1] = 'private';
            } elseif ($originalName !== null && $token[0] === T_METHOD_C) {
                // Replace __METHOD__ constant.
                $this->tokens[$index][0] = T_STRING;
                $this->tokens[$index][1] = "__CLASS__ . '::{$originalName}'";
            } elseif ($originalName !== null && $token[0] === T_FUNC_C) {
                // Replace __FUNCTION__ constant.
                $this->tokens[$index][0] = T_STRING;
                $this->tokens[$index][1] = "'{$originalName}'";
            }
        }
        if( $classToken !== -1 ) {
            $body = $this->findBody($classToken);
            $end  = $this->findClosingBrace($body);
            // Inject new methods at the end of the class body.
            $injectedCode = implode(PHP_EOL, $injectionPoints);
            $source = $this->between(0, $end - 1) . $injectedCode . $this->between($end, count($this->tokens) - 1);
        }
        return $source;
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
        $template = '    %1$s'                                                                             . PHP_EOL
                  . '    {'                                                                                . PHP_EOL
                  . '        if( AspectPHP_Container::hasManager() ) {'                                    . PHP_EOL
                  . '            $aspects = AspectPHP_Container::getManager()->getAspectsFor(__METHOD__);' . PHP_EOL
                  . '        } else {'                                                                     . PHP_EOL
                  . '            $aspects = array();'                                                      . PHP_EOL
                  . '        }'                                                                            . PHP_EOL
                  . '        $args = func_get_args();'                                                     . PHP_EOL
                  . '        if( count($aspects) === 0 ) {'                                                . PHP_EOL
                  . '            return call_user_func_array(array(%2$s, \'%3$s\'), $args);'               . PHP_EOL
                  . '        }'                                                                            . PHP_EOL
                  . '        $joinPoint = new AspectPHP_JoinPoint(__METHOD__, $args);'                     . PHP_EOL
                  . '        foreach( $aspects as $aspect ) {'	                                           . PHP_EOL
                  . '            $aspect->before($joinPoint);'                                             . PHP_EOL
                  . '        }'                                                                            . PHP_EOL
                  . '        try {'                                                                        . PHP_EOL
                  . '            $returnValue = call_user_func_array(array(%2$s, \'%3$s\'), $args);'       . PHP_EOL
                  . '            $joinPoint->setReturnValue($returnValue);'                                . PHP_EOL
                  . '            foreach( $aspects as $aspect ) {'	                                       . PHP_EOL
                  . '                $aspect->afterReturning($joinPoint);'                                 . PHP_EOL
                  . '            }'                                                                        . PHP_EOL
                  . '            return $joinPoint->getReturnValue();'                                     . PHP_EOL
                  . '        } catch(Exception $e) {'                                                      . PHP_EOL
                  . '            $joinPoint->setException($e);'                                            . PHP_EOL
                  . '            foreach( $aspects as $aspect ) {'	                                       . PHP_EOL
                  . '                $aspect->afterThrowing($joinPoint);'                                  . PHP_EOL
                  . '            }'                                                                        . PHP_EOL
                  . '            throw $e;'                                                                . PHP_EOL
                  . '        }'                                                                            . PHP_EOL
                  . '    }'                                                                                . PHP_EOL;
        return sprintf($template, $signature, $context, $callee);
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
        $numberOfTokens = count($this->tokens);
        for( $i = $functionIndex + 1; $numberOfTokens; $i++ ) {
            if( is_array($this->tokens[$i]) && $this->tokens[$i][0] === T_STRING ) {
                return $i;
            }
        }
        return -1;
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
        for( $i = $functionIndex - 1; $i >= 0; $i-- ) {
            if( is_array($this->tokens[$i]) && in_array($this->tokens[$i][0], $visibilities) ) {
                return $i;
            }
        }
        return -1;
    }
    
    /**
     * Returns the index of the doc block that belongs to the method that is
     * declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findDocBlock($functionIndex) {
        for( $i = $functionIndex - 1; $i >= 0; $i-- ) {
            if( is_array($this->tokens[$i]) && $this->tokens[$i][0] === T_DOC_COMMENT ) {
                return $i;
            }
        }
        return -1;
    }
    
    /**
     * Returns the index of the next "{" token that starts a body.
     *
     * @param integer $index
     * @return integer
     */
    protected function findBody($index) {
        $numberOfTokens = count($this->tokens);
        for( $i = $index + 1; $numberOfTokens; $i++ ) {
            if( is_string($this->tokens[$i]) && $this->tokens[$i] === '{' ) {
                return $i;
            }
        }
        return -1;
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
    
}

?>