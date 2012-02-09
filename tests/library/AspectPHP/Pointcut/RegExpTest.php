<?php

/**
 * AspectPHP_Pointcut_RegExpTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the regular expression pointcut.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */
class AspectPHP_Pointcut_RegExpTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Ensures that the constructor throws an exception if an empty string
     * is provided.
     */
    public function testConstructorThrowsExceptionIfEmptyStringIsProvided() {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if no string is provided.
     */
    public function testConstructorThrowsExceptionIfNoStringIsProvided() {
        
    }
    
    /**
     * Checks if matches() returns a boolean value.
     */
    public function testMatchesReturnsBoolean() {
        
    }
    
    /**
     * Ensures that matches() returns true if the expression matches
     * the provided method.
     */
    public function testMatchesReturnsTrueIfExpressionMatchesMethod() {
        
    }
    
    /**
     * Ensures that matches() returns false if the expression does not match
     * the provided method.
     */
    public function testMatchesReturnsFalseIfExpressionDoesNotMatchMethod() {
        
    }
    
    /**
     * Ensures that matches() returns true if the expression matches a method
     * whose class uses a namespace.
     */
    public function testMatchesReturnsTrueIfExpressionMatchesNamespacedClass() {
        
    }
    
    /**
     * Ensures that matches() returns false if the expression does not match a method
     * whose class uses a namespace.
     */
    public function testMatchesReturnsTrueIfExpressionDoesNotMatchNamespacedClass() {
        
    }
    
    /**
     * Uses the given expression to create a pointcut.
     *
     * @param string $expression
     * @return AspectPHP_Pointcut_RegExp
     */
    protected function create($expression) {
        
    }
    
}

?>