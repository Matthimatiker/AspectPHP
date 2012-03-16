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
        $this->editor = $this->createEditor($tokens);
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
     * Ensures that replace() throws an exception if the provided list of token
     * indexes contains invalid values.
     */
    public function testReplaceThrowsExceptionIfListWithInvalidIndexIsProvided() {
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->replace(array(2, -1), 'n');
    }
    
	/**
     * Checks if replace() substitutes all tokens whose indexes were provided
     * in the list.
     */
    public function testReplaceSubstitutesAllProvidedTokensAfterCommit() {
        $this->editor->replace(array(0, 1), 'a');
        $this->editor->commit();
        $this->assertEquals('a', $this->editor[0]);
        $this->assertEquals('a', $this->editor[1]);
    }
    
    /**
     * Ensures that replace() keeps the line number of the original token if the
     * new token does not provide one.
     *
     * Example:
     * <code>
     * $editor->replace(5, array(T_STRING, 'hello'));
     * </code>
     */
    public function testReplaceKeepsOriginalLineNumberIfNewTokenDoesNotProvideOne() {
        $this->editor = $this->createEditor(array($this->createTextToken()));
        $newToken = array(
            T_STRING,
            'test'
        );
        $this->editor->replace(0, $newToken);
        $this->editor->commit();
        $this->assertTrue(isset($this->editor[0][2]));
        $this->assertEquals(1, $this->editor[0][2]);
    }
    
    /**
     * Ensures that replace() inserts a dummy line number if the new token does
     * not provide one and there is also none defined in the original token (that
     * is the case if the token is a string, for example a brace).
     */
    public function testReplaceInsertsDummyLineNumberIfOriginalNumberIsNotAvailable() {
        $newToken = array(
            T_STRING,
            'test'
        );
        $this->editor->replace(0, $newToken);
        $this->editor->commit();
        $this->assertTrue(isset($this->editor[0][2]));
    }
    
    /**
     * Ensures that replace() uses the line number of the new token if
     * it is available.
     */
    public function testReplaceUsesProvidedLineNumber() {
        $this->editor = $this->createEditor(array($this->createTextToken()));
        $newToken = array(
            T_STRING,
            'test',
            42
        );
        $this->editor->replace(0, $newToken);
        $this->editor->commit();
        $this->assertEquals(42, $this->editor[0][2]);
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
     * Ensures that remove() throws an exception if the provided list of token
     * indexes contains invalid values.
     */
    public function testRemoveThrowsExceptionIfListWithInvalidIndexIsProvided() {
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->remove(array(2, -1));
    }
    
    /**
     * Checks if remove() deletes all tokens whose indexes were provided in the list.
     */
    public function testRemoveDeletesAllProvidedTokensAfterCommit() {
        $numberOfTokens = count($this->editor);
        $tokensToDelete = array(1, 2);
        $this->editor->remove($tokensToDelete);
        $this->editor->commit();
        $this->assertEquals($numberOfTokens - count($tokensToDelete), count($this->editor));
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
    
    /**
     * If multiple changes are competing for the modification of the
     * same token then the last one will be applied.
     */
    public function testLastChangeThatModifiesTokenIsApplied() {
        $this->editor->replace(0, 'a');
        $this->editor->remove(0);
        $this->editor->replace(0, 'b');
        $this->editor->commit();
        $this->assertEquals('b2345', (string)$this->editor);
    }
    
    /**
     * Ensures that rename() throws an exception if an invalid index is provided.
     */
    public function testRenameThrowsExceptionIfInvalidIndexIsProvided() {
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->rename(-1, 'test');
    }
    
    /**
     * Ensures that rename() throws an exception if the provided index points
     * to a token of invalid type.
     */
    public function testRenameThrowsExceptionIfTokenOfInvalidTypeIsProvided() {
        $this->setExpectedException('InvalidArgumentException');
        $this->editor->rename(1, 'test');
    }
    
    /**
     * Ensures that rename() does not modify the token before the changes
     * are committed.
     */
    public function testRenameDoesNotModifyTokenIfChangesAreNotCommitted() {
        $tokens = array(
            $this->createTextToken()
        );
        $this->editor = $this->createEditor($tokens);
        $this->editor->rename(0, 'test');
        $this->assertEquals('myName', $this->editor[0][1]);
    }
    
    /**
     * Checks if rename changes the content of the token.
     */
    public function testRenameChangesTokenContentAfterCommit() {
        $tokens = array(
            $this->createTextToken()
        );
        $this->editor = $this->createEditor($tokens);
        $this->editor->rename(0, 'test');
        $this->editor->commit();
        $this->assertEquals('test', $this->editor[0][1]);
    }
    
    /**
     * Checks if rename() keeps the original line number of the
     * provided token.
     */
    public function testRenameKeepsLineNumberOfToken() {
        $tokens = array(
            $this->createTextToken()
        );
        $this->editor = $this->createEditor($tokens);
        $this->editor->rename(0, 'test');
        $this->editor->commit();
        $this->assertEquals(1, $this->editor[0][2]);
    }
    
    /**
     * Uses the given tokens to create an editor.
     *
     * @param array(string|array(string|integer)) $tokens
     * @return AspectPHP_Code_TokenEditor
     */
    protected function createEditor(array $tokens) {
        return new AspectPHP_Code_TokenEditor($tokens);
    }
    
    /**
     * Creates a token of type T_STRING.
     *
     * @return array(integer|string)
     */
    protected function createTextToken() {
        $token = array(
            T_STRING,
            'myName',
            1
        );
        return $token;
    }
    
}