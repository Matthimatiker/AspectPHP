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
        $this->tokens = token_get_all($source);
        foreach( $this->tokens as $index => $token ) {
            /* @var array(integer=>string|integer)|string */
            if( $token[0] === T_FUNCTION ) {
                
            }
        }
        return $source;
    }
    
    /**
     *
     */
    protected function buildInjectionPoint() {
        
    }
    
    /**
     * Returns the index of the token that contains the name of the
     * method that is declared by the given function token.
     *
     * @param integer $functionIndex Index of a T_FUNCTION token.
     * @return integer
     */
    protected function findMethodNameToken($functionIndex) {
        $numberOfTokens = count($this->tokens);
        for( $i = $functionIndex + 1; $numberOfTokens; $i++ ) {
            if( is_array($this->tokens[$i]) && $this->tokens[$i][0] === T_STRING ) {
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