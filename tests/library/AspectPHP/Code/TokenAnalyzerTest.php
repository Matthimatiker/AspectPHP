<?php

/**
 * AspectPHP_Code_TokenAnalyzerTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 27.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the token analyzer.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 27.01.2012
 */
class AspectPHP_Code_TokenAnalyzerTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Checks if count() returns the number of tokens.
     */
    public function testCountReturnsNumberOfTokens() {
        
    }
    
    /**
     * Enures that offsetExists() returns false if the given token index does not exist.
     */
    public function testOffsetExistsReturnsFalseIfIndexDoesNotExist() {
        
    }
    
    /**
     * Ensures that offsetExists() returns true if the provided token index exists.
     */
    public function testOffsetExistsReturnsTrueIfExistingIndexIsProvided() {
        
    }
    
    /**
     * Ensures that offsetGet() throws an exception if the given index does not exist.
     */
    public function testOffsetGetThrowsExceptionIfIndexDoesNotExist() {
        
    }
    
    /**
     * Checks if offsetGet() returns the correct token.
     */
    public function testOffsetGetReturnsCorrectToken() {
        
    }
    
    /**
     * Ensures that offsetSet() throws an exception.
     */
    public function testOffsetSetThrowsException() {
        
    }
    
    /**
     * Ensures that offsetUnset() throws an exception.
     */
    public function testOffsetUnsetThrowsException() {
        
    }
    
    /**
     * Checks if getIterator() returns an instance of Traversable.
     */
    public function testGetIteratorReturnsTraversable() {
        
    }
    
    /**
     * Checks if the analyzer supports an iteration over the tokens.
     */
    public function testIteratingOverTokensIsPossible() {
        
    }
    
    /**
     * Ensures that the magic __toString() method returns the original source code.
     */
    public function testToStringReturnsOriginalSourceCode() {
        
    }
    
    /**
     * Ensures that findBetween() returns -1 if no token was found.
     */
    public function testFindBetweenReturnsCorrectValueIfTokenWasNotFound() {
        
    }
    
    // TODO: token not in range
    
    /**
     * Checks if findBetween() returns the correct token index.
     */
    public function testFindBetweenReturnsCorrectIndex() {
        
    }
    
    /**
     * Checks if findBetween() searches the token at the start index.
     */
    public function testFindBetweenIncludesStartIndex() {
        
    }
    
    /**
     * Checks if findBetween() searches the token at the end index.
     */
    public function testFindBetweenIncludesEndIndex() {
        
    }
    
    /**
     * Ensures that findBetween() searches in descending order if the start index is
     * greater than the end index.
     */
    public function testFindBetweenSearchesInDescendingOrderIfStartIsGreaterThanEnd() {
        
    }
    
    /**
     * Ensures that findBetween() returns -1 if a stop token is encountered during search.
     */
    public function testFindBetweenReturnsCorrectValueIfStopTokenIsEncountered() {
        
    }
    
    /**
     * Ensures that findBetween() throws an exception if an invalid start index is provided.
     */
    public function testFindBetweenThrowsExceptionIfInvalidStartIndexIsProvided() {
        
    }
    
    /**
     * Ensures that findBetween() throws an exception if an invalid end index is provided.
     */
    public function testFindBetweenThrowsExceptionIfInvalidEndIndexIsProvided() {
        
    }
    
    /**
     * Checks if findNext() returns the index of the result token.
     */
    public function testFindNextReturnsCorrectValue() {
        
    }
    
    /**
     * Ensures that findNext() returns -1 if no token was found.
     */
    public function testFindNextReturnsCorrectValueIfTokenWasNotFound() {
        
    }
    
    /**
     * Ensures that findNext() does not search the provided start index.
     */
    public function testFindNextDoesNotIncludeStartIndex() {
        
    }
    
    /**
     * Ensures that findNext() returns -1 if a stop token is found during search.
     */
    public function testFindNextReturnsCorrectValueIfStopTokenIsEncountered() {
        
    }
    
    /**
     * Ensures that findNext() throws an exception if an invalid index is provided.
     */
    public function testFindNextThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    /**
     * Checks if findPrevious() returns the index of the result token.
     */
    public function testFindPreviousReturnsCorrectValue() {
        
    }
    
    /**
     * Ensures that findPrevious() returns -1 if no token was found.
     */
    public function testFindPreviousReturnsCorrectValueIfTokenWasNotFound() {
        
    }
    
    /**
     * Ensures that findPrevious() does not search the provided start index.
     */
    public function testFindPreviousDoesNotIncludeStartIndex() {
        
    }
    
    /**
     * Ensures that findPrevious() returns -1 if a stop token is found during search.
     */
    public function testFindPreviousReturnsCorrectValueIfStopTokenIsEncountered() {
        
    }
    
    /**
     * Ensures that findPrevious() throws an exception if an invalid index is provided.
     */
    public function testFindPreviousThrowsExceptionIfInvalidIndexIsProvided() {
        
    }
    
    /**
     * Ensures that findMatchingBrace() returns the correct token index if the
     * braces are not nested.
     */
    public function testFindMatchingBraceReturnsCorrectIndexIfBracesAreNotNested() {
        
    }
    
    /**
     * Ensures that findMatchingBrace() returns the correct token index if the
     * braces are nested.
     */
    public function testFindMatchingBraceReturnsCorrectIndexIfBracesAreNested() {
        
    }
    
    /**
     * Checks if findMatchingBrace() distinguishes between the different brace
     * types and returns the correct closing brace.
     */
    public function testFindMatchingBraceReturnsCorrectClosingBrace() {
        
    }
    
    // TODO: opening brace
    
    /**
     * Checks if findMatchingBrace() supports parentheses ("(" and ")").
     */
    public function testFindMatchingBraceSupportsParentheses() {
        
    }
    
    // TODO: invalid index
    
    /**
     * Ensures that findMatchingBrace() throws an exception if the provided index
     * does not belong to a brace token.
     */
    public function testFindMatchingBraceThrowsExceptionIfNoBraceIndexIsProvided() {
        
    }
    
    /**
     * Ensures that findMatchingBrace() throws an exception if no matching brace
     * was found.
     * No matching braces may be explained by incorrect source code.
     */
    public function testFindMatchingBraceThrowsExceptionIfNoMatchingBraceWasFound() {
        
    }
    
}

?>