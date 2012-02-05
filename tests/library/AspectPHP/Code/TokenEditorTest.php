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
     * System under test.
     *
     * @var AspectPHP_Code_TokenEditor
     */
    protected $editor = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $tokens = array(
        	'1',
        	'2',
        	'3',
        	'4',
        	'5'
        );
        $this->editor = new AspectPHP_Code_TokenEditor($tokens);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->editor = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that discard() does nothing if no pending changes are available.
     */
    public function testDiscardDoesNothingIfThereAreNoPendingChanges() {
        $this->setExpectedException(null);
        $this->editor->discard();
    }
    
    /**
     * Ensures that commit() does nothing if no pending changes are available.
     */
    public function testCommitDoesNothingIfThereAreNoPendingChanges() {
        $this->setExpectedException(null);
        $this->editor->commit();
    }
    
    /**
     * Ensures that replace() throws an exception if an invalid index
     * is provided.
     */
    public function testReplaceThrowsExceptionIfInvalidIndexIsProvided() {
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->replace(-1, '7');
    }
    
    /**
     * Ensures that replace() does not modify the tokens before commit() is called.
     */
    public function testReplaceDoesNotChangeTokensIfChangesAreNotCommitted() {
        $this->editor->replace(0, '7');
        $this->assertNotEquals('7', $this->editor[0]);
    }
    
    /**
     * Checks if replace() changes the token after commit.
     */
    public function testReplaceChangesTokenContentAfterCommit() {
        $this->editor->replace(0, '7');
        $this->editor->commit();
        $this->assertEquals('7', $this->editor[0]);
    }
    
    /**
     * Ensures that remove() throws an exception if an invalid index
     * is provided.
     */
    public function testRemoveThrowsExceptionIfInvalidIndexIsProvided() {
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->remove(-1);
    }
    
    /**
     * Ensures that remove() does not modify the tokens before commit() is called.
     */
    public function testRemoveDoesNotChangeTokensIfChangesAreNotCommitted() {
        $numberOfTokens = count($this->editor);
        $this->editor->remove(4);
        $this->assertEquals($numberOfTokens, count($this->editor));
    }
    
    /**
     * Checks if remove() deletes the token after commit.
     */
    public function testRemoveDeletesTokenAfterCommit() {
        $numberOfTokens = count($this->editor);
        $this->editor->remove(4);
        $this->editor->commit();
        $this->assertEquals($numberOfTokens - 1, count($this->editor));
    }
    
    /**
     * Ensures that the editor rearranges the token indexes if a token in
     * the middle of the source is removed.
     */
    public function testEditorRearrangesIndexesAfterRemovingToken() {
        $this->editor->remove(2);
        $this->editor->commit();
        $this->assertEquals('1', $this->editor[0]);
        $this->assertEquals('2', $this->editor[1]);
        $this->assertEquals('4', $this->editor[2]);
        $this->assertEquals('5', $this->editor[3]);
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