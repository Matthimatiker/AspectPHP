<?php

/**
 * AspectPHP_Code_TokenEditor
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.02.2012
 */

/**
 * The token editor allows the manipulation of tokenized source code.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.02.2012
 */
class AspectPHP_Code_TokenEditor extends AspectPHP_Code_TokenAnalyzer {
    
    /**
     * Replaces the token at position $index with $newToken.
     *
     * @param integer $index
     * @param string|array(integer|string) $newToken
     */
    public function replace($index, $newToken) {
        
    }
    
    /**
     * Removes the token at position $index.
     *
     * @param integer $index
     */
    public function remove($index) {
        
    }
    
    /**
     * Commits all pending changes.
     */
    public function commit() {
        
    }
    
    /**
     * Discards all queued changes.
     */
    public function discard() {
        
    }
    
}

?>