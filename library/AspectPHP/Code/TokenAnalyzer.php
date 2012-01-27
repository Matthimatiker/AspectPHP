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
class AspectPHP_Code_TokenAnalyzer implements ArrayAccess, Countable {
    
    /**
     * Creates an analyzer.
     *
     * @param array(array|string) $tokens The tokenized source code.
     */
    public function __construct(array $tokens) {
        
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
    
}

?>