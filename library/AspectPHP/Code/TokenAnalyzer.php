<?php

/**
 * AspectPHP_Code_TokenAnalyzer
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 27.01.2012
 */

/**
 * Analyzes tokenized source code.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 27.01.2012
 */
class AspectPHP_Code_TokenAnalyzer implements ArrayAccess, Countable, IteratorAggregate  {
    
    /**
     * Creates an analyzer.
     *
     * @param array(array|string) $tokens The tokenized source code.
     */
    public function __construct(array $tokens) {
        
    }
    
    /**
     * Searches for the first token after $index that meets the given requirements.
     *
     * See {@link findBetween()} for details about the search options.
     *
     * @param integer|string $type
     * @param integer $index
     * @param array(integer|string) $stopAt
     * @return integer
     */
    public function findNext($type, $index, array $stopAt = array()) {
        
    }
    
    /**
     * Searches for the first token before $index that meets the given requirements.
     *
     * See {@link findBetween()} for details about the search options.
     *
     * @param integer|string $type
     * @param integer $index
     * @param array(integer|string) $stopAt
     * @return integer
     */
    public function findPrevious($type, $index, array $stopAt = array()) {
        
    }
    /**
     * Searches between $start and $end for the given token type.
     *
     * The method returns -1 if the token was not found and the index
     * of the result token otherwise.
     *
     * The given type can be a type constant (for example T_FUNCTION) or a
     * token string (for example "{" or ";").
     *
     * If $start is greater than $end the search will be executed in descending
     * order. Otherwise ascending order will be used.
     *
     * Optionally an array of stop types may be specified via $stopAt.
     * If one of these types is found during the search then -1 will be returned.
     *
     * @param integer|string $type The search token.
     * @param integer $start The start index.
     * @param integer $end The end index.
     * @param array(integer|string) $stopAt List of tokens that will stop the search process.
     * @return integer The index of the result token or -1 if none was found.
     */
    public function findBetween($type, $start, $end, array $stopAt = array()) {
        
    }
    
    /**
     * Searches for the opening/closing brace that belongs to the brace at $index.
     *
     * @param integer $index The index of the brace token.
     * @return integer The index of the matchimng brace or -1.
     * @throws InvalidArgumentException If the provided index does not belong to a brace token.
     */
    public function findMatchingBrace($index) {
        
    }
    
    /**
     * Checks if the token with the given offset exists.
     *
     * @param integer $offset
     * @return boolean
     */
    public function offsetExists($offset) {
        
    }
    
    /**
     * Returns the token with the given offset.
     *
     * @param integer $offset
     * @return array(mixed)|string
     * @throws InvalidArgumentException If the token with the provided offset does not exist.
     */
    public function offsetGet($offset) {
        
    }
    
    /**
     * Modifying tokens is not supported, therefore a BadMethodCallException is thrown.
     *
     * @param integer $offset
     * @param array(mixed)|string $value
     * @throws BadMethodCallException Always throws an exception.
     */
    public function offsetSet($offset, $value) {
        
    }
    
    /**
     * Deleting tokens is not supported, therefore a BadMethodCallException is thrown.
     *
     * @param integer $offset
     * @throws BadMethodCallException Always throws an exception.
     */
    public function offsetUnset($offset) {
        
    }
    
    /**
     * Returns the number of tokens.
     *
     * @return integer
     */
    public function count() {
        
    }
    
    /**
     * Returns an iterator that is used to loop over the tokens.
     *
     * @return Traversable
     */
    public function getIterator () {
        
    }
    
    /**
     * Returns the source code that is analyzed.
     *
     * @return string
     */
    public function __toString() {
        
    }
    
}

?>