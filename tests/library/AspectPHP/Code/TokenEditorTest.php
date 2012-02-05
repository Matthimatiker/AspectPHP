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
    
    public function testDiscardDoesNothingIfThereAreNoPendingChanges() {
        
    }
    
    public function testCommitDoesNothingIfThereAreNoPendingChanges() {
        
    }
    
    public function testReplaceThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    public function testReplaceDoesNotChangeTokensIfChangesAreNotCommitted() {
        
    }
    
    public function testReplaceChangesTokenContentAfterCommit() {
        
    }
    
    public function testRemoveThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    public function testRemoveDoesNotChangeTokensIfChangesAreNotCommitted() {
        
    }
    
    public function testRemoveDeletesTokenAfterCommit() {
        
    }
    
    public function testInsertBeforeThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    public function testInsertBeforeDoesNotChangeTokensIfChangesAreNotCommitted() {
        
    }
    
    public function testInsertBeforeAddsTokensAfterCommit() {
       
    }
    
    public function testInsertBeforeAddsTokensAtCorrectPositionAfterCommit() {
       
    }
    
    public function testDiscardRemovesPreviousChangeRequests() {
        
    }
    
    public function testToStringReturnsModifiedSourceCode() {
        
    }
    
    public function testMultipleQueuedChangesAreAppliedCorrectly() {
        
    }
    
}

?>