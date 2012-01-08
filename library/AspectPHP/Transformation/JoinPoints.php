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
        foreach( $this->tokens as $index => $token ) {
            /* @var array(integer=>string|integer)|string */
            if( is_string($token) ) {
                continue;
            }
            if( $token[0] === T_CLASS ) {
                $classToken = $index;
            } elseif( $classToken !== -1 && $token[0] === T_FUNCTION ) {
                $docComment = $this->findDocBlock($index);
                $bodyStart  = $this->findBody($index);
                $visibility = $this->findMethodVisibility($index);
                $name       = $this->findMethodName($index);
                $newName    = '_aspectPHP' . $this->tokens[$name][1];
                $signature  = $this->between($docComment, $bodyStart - 1);
                
                $injectionPoints[] = $this->buildInjectionPoint($signature, $newName);
                
                // Rename the original method and reduce the visibility.
                $this->tokens[$name][1]       = $newName;
                $this->tokens[$visibility][0] = T_PRIVATE;
                $this->tokens[$visibility][1] = 'private';
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
     * @return string The code of the generated injection point method.
     */
    protected function buildInjectionPoint($signature, $callee) {
        $template = '%s {'                                                    . PHP_EOL
                  . '    $args = func_get_args();'                            . PHP_EOL
                  . '    return call_user_func_array(array($this, \'%s\'), $args);' . PHP_EOL
                  . '}'                                                       . PHP_EOL;
        return sprintf($template, $signature, $callee);
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