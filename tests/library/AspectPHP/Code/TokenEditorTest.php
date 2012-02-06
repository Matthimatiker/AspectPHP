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
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->insertBefore(-1, array('7'));
    }
    
    /**
     * Ensures that insertBefore() does not modify the tokens before commit() is called.
     */
    public function testInsertBeforeDoesNotChangeTokensIfChangesAreNotCommitted() {
        $numberOfTokens = count($this->editor);
        $this->editor->insertBefore(1, array('7'));
        $this->assertEquals($numberOfTokens, count($this->editor));
    }
    
    /**
     * Checks if insertBefore() adds the tokens after commit.
     */
    public function testInsertBeforeAddsTokensAfterCommit() {
        $numberOfTokens = count($this->editor);
        $this->editor->insertBefore(0, array('0'));
        $this->editor->commit();
        $this->assertEquals($numberOfTokens + 1, count($this->editor));
    }
    
    /**
     * Checks if insertBefore() adds the tokens at the correct position.
     */
    public function testInsertBeforeAddsTokensAtCorrectPositionAfterCommit() {
       $this->editor->insertBefore(1, array('8', '9'));
       $this->editor->commit();
       $this->assertEquals('8', $this->editor[1]);
       $this->assertEquals('9', $this->editor[2]);
    }
    
    /**
     * Ensures that discard() removes pending changes.
     */
    public function testDiscardRemovesPreviousChangeRequests() {
        $this->editor->replace(0, '9');
        $this->editor->discard();
        $this->editor->replace(1, '8');
        $this->editor->commit();
        // The first change was discarded...
        $this->assertNotEquals('9', $this->editor[0]);
        // ... but the second was committed.
        $this->assertEquals('8', $this->editor[1]);
    }
    
    /**
     * Checks if the magic method __toString() returns the modified source code.
     */
    public function testToStringReturnsModifiedSourceCode() {
        $this->editor->replace(0, '0');
        $this->editor->commit();
        $source = (string)$this->editor;
        $this->assertEquals('02345', $source);
    }
    
    /**
     * Checks if multiple pending changes are applied correctly.
     */
    public function testMultipleQueuedChangesAreAppliedCorrectly() {
        $this->editor->replace(0, '0');
        $this->editor->insertBefore(4, array('a', 'b'));
        $this->editor->insertBefore(2, array('c', 'd'));
        $this->editor->commit();
        $source = (string)$this->editor;
        $this->assertEquals('02cd34ab5', $source);
    }
    
    /**
     * Ensures that the editor does not apply the same changes
     * twice.
     */
    public function testEditorDoesNotApplyChangesTwice() {
        $this->editor->insertBefore(0, array('a'));
        $this->editor->commit();
        $source = (string)$this->editor;
        // Calling commit() again should not modify the tokens.
        $this->editor->commit();
        $this->assertEquals($source, (string)$this->editor);
    }
    
}

?>