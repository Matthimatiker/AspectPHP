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
        $change = $this->createChange('replace', $index);
        $change->newToken = $newToken;
        $this->registerChange($change);
    }
    
    /**
     * Removes the token at position $index.
     *
     * @param integer $index
     */
    public function remove($index) {
        $change = $this->createChange('remove', $index);
        $this->registerChange($change);
    }
    
    /**
     * Inserts the given token list before the given position.
     *
     * @param integer $index The referenced position.
     * @param array(string|array(integer|string)) $tokens A list of tokens.
     */
    public function insertBefore($index, array $tokens) {
        $change = $this->createChange('insertBefore', $index);
        $change->tokens = $tokens;
        $this->registerChange($change);
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
        // The changes are sorted by refIndex and are applied in
        // ascending order. That allows us to handle the index
        // drift that may occur.
        usort($this->changes, array($this, 'compareByRefIndex'));
        // $delta contains the index drift from all previous changes.
        $delta = 0;
        foreach( $this->changes as $change ) {
            /* @var $change stdClass */
            $change->refIndex += $delta;
            $delta += call_user_func($this->getApplyMethod($change), $change);
        }
    }
    
    /**
     * Replaces the token that is denoted by the change.
     *
     * @param stdClass $change
     * @return integer The index drift.
     */
    protected function applyReplace(stdClass $change) {
        $this->tokens[$change->refIndex] = $change->newToken;
        return 0;
    }
    
    /**
     * Removes the token that is denoted by the change.
     *
     * @param stdClass $change
     * @return integer The index drift.
     */
    protected function applyRemove(stdClass $change) {
        unset($this->tokens[$change->refIndex]);
        // Normalize the keys.
        $this->tokens = array_values($this->tokens);
        return -1;
    }
    
    /**
     * Inserts the given tokens in front of the reference index.
     *
     * @param stdClass $change
     * @return integer The index drift.
     */
    protected function applyInsertBefore(stdClass $change) {
        $tokens = $change->tokens;
        array_splice($this->tokens, $change->refIndex, 0, $tokens);
        return count($tokens);
    }
    
    /**
     * Returns a callback to the method that is responsible for
     * applying the provided change.
     *
     * @param stdClass $change
     * @return array A callback.
     */
    protected function getApplyMethod(stdClass $change) {
        return array($this, 'apply' . ucfirst($change->type));
    }
    
    /**
     * Creates a new change set.
     *
     * @param string $type The type of the change.
     * @param integer $refIndex The reference index.
     * @return stdClass
     */
    protected function createChange($type, $refIndex) {
        $this->assertIsIndex($refIndex);
        $change = new stdClass();
        $change->type     = $type;
        $change->refIndex = $refIndex;
        return $change;
    }
    
    /**
     * Registers a change set that will be applied with the next commit.
     *
     * @param stdClass $change
     */
    protected function registerChange(stdClass $change) {
        $this->changes[] = $change;
    }
    
    /**
     * Compares the given change sets by reference index.
     *
     * @param stdClass $left
     * @param stdClass $right
     * @return integer
     */
    private function compareByRefIndex(stdClass $left, stdClass $right) {
        return $left->refIndex - $right->refIndex;
    }
    
}

?>