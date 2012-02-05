<?php

/**
 * AspectPHP_Code_TokenEditorTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.02.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the token editor.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.02.2012
 */
class AspectPHP_Code_TokenEditorTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Ensures that discard() does nothing if no pending changes are available.
     */
    public function testDiscardDoesNothingIfThereAreNoPendingChanges() {
        
    }
    
    /**
     * Ensures that commit() does nothing if no pending changes are available.
     */
    public function testCommitDoesNothingIfThereAreNoPendingChanges() {
        
    }
    
    /**
     * Ensures that replace() throws an exception if an invalid index
     * is provided.
     */
    public function testReplaceThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    /**
     * Ensures that replace() does not modify the tokens before commit() is called.
     */
    public function testReplaceDoesNotChangeTokensIfChangesAreNotCommitted() {
        
    }
    
    /**
     * Checks if replace() changes the token after commit.
     */
    public function testReplaceChangesTokenContentAfterCommit() {
        
    }
    
    /**
     * Ensures that remove() throws an exception if an invalid index
     * is provided.
     */
    public function testRemoveThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    /**
     * Ensures that remove() does not modify the tokens before commit() is called.
     */
    public function testRemoveDoesNotChangeTokensIfChangesAreNotCommitted() {
        
    }
    
    /**
     * Checks if remove() deletes the token after commit.
     */
    public function testRemoveDeletesTokenAfterCommit() {
        
    }
    
    /**
     * Ensures that insertBefore() throws an exception if an invalid index
     * is provided.
     */
    public function testInsertBeforeThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    /**
     * Ensures that insertBefore() does not modify the tokens before commit() is called.
     */
    public function testInsertBeforeDoesNotChangeTokensIfChangesAreNotCommitted() {
        
    }
    
    /**
     * Checks if insertBefore() adds the tokens after commit.
     */
    public function testInsertBeforeAddsTokensAfterCommit() {
       
    }
    
    /**
     * Checks if insertBefore() adds the tokens at the correct position.
     */
    public function testInsertBeforeAddsTokensAtCorrectPositionAfterCommit() {
       
    }
    
    /**
     * Ensures that discard() removes pending changes.
     */
    public function testDiscardRemovesPreviousChangeRequests() {
        
    }
    
    /**
     * Checks if the magic method __toString() returns the modified source code.
     */
    public function testToStringReturnsModifiedSourceCode() {
        
    }
    
    /**
     * Checks if multiple pending changes are applied correctly.
     */
    public function testMultipleQueuedChangesAreAppliedCorrectly() {
        
    }
    
}

?>