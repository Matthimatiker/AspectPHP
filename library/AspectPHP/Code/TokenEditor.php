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
     * A list of queued changes.
     *
     * Each change is represented by a stdClass object
     * that contains at least the attributes "type" and
     * "refIndex".
     *
     * @var array(integer=>stdClass)
     */
    protected $changes = array();
    
    /**
     * Replaces the token at position $index with $newToken.
     *
     * @param integer $index
     * @param string|array(integer|string) $newToken
     */
    public function replace($index, $newToken) {
        $change = new stdClass();
    }
    
    /**
     * Removes the token at position $index.
     *
     * @param integer $index
     */
    public function remove($index) {
        
    }
    
    /**
     * Inserts the given token list before the given position.
     *
     * @param integer $index The referenced position.
     * @param array(string|array(integer|string)) $tokens A list of tokens.
     */
    public function insertBefore($index, array $tokens) {
        
    }
    
    /**
     * Commits all pending changes.
     */
    public function commit() {
        $this->applyChanges();
    }
    
    /**
     * Discards all queued changes.
     */
    public function discard() {
        $this->changes = array();
    }
    
    /**
     * Applies all queued changes.
     */
    protected function applyChanges() {
        
    }
    
    /**
     * Compares the given change sets by reference index.
     *
     * @param stdClass $left
     * @param stdClass $right
     * @return integer
     */
    private function compareByRefIndex(stdClass $left, stdClass $right) {
        
    }
    
}

?>