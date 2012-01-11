<?php

/**
 * AspectPHP_JoinPointTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 08.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the JoinPoint implementation.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 08.01.2012
 */
class AspectPHP_JoinPointTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Checks if getClass() returns the name of the class that contains the method.
     */
    public function testGetClassReturnsCorrectValue() {
        
    }
    
    /**
     * Checks if getMethod() returns the name of the method.
     */
    public function testGetMethodReturnsCorrectValue() {
        
    }
    
    /**
     * Ensures that getReturnValue() returns null if no value was provided.
     */
    public function testGetReturnValueReturnsNullIfNoValueWasProvided() {
        
    }
    
    /**
     * Checks if getReturnsValue() returns the correct value.
     */
    public function testGetReturnValueReturnsCorrectValue() {
        
    }
    
    /**
     * Checks if setReturnsValue() provides a fluent interface.
     */
    public function testSetReturnValueProvidesFluentInterface() {
        
    }
    
    /**
     * Ensures that getException() returns null if no exception was provided.
     */
    public function testGetExceptionReturnsNullIfNoExceptionWasProvided() {
        
    }
    
    /**
     * Checks if getException() returns the correct exception object.
     */
    public function testGetExceptionReturnsCorrectObject() {
        
    }
    
    /**
     * Ensures that setException() accepts null.
     */
    public function testSetExceptionAcceptsNull() {
        
    }
    
    /**
     * Checks if setException() provides a fluent interface.
     */
    public function testSetExceptionProvidesFluentInterface() {
        
    }
    
    /**
     * Checks if getArguments() returns an array.
     */
    public function testGetArgumentsReturnsArray() {
        
    }
    
    /**
     * Ensures that getArguments() returns correct values.
     */
    public function testGetArgumentsReturnsCorrectValues() {
        
    }
    
    /**
     * Ensures that getArguments() returns the correct values if a default
     * parameter was used when the method was called.
     */
    public function testGetArgumentsReturnsCorrectValuesIfDefaultParameterIsUsed() {
        
    }
    
    /**
     * Checks if getArgument() returns the correct value for a given
     * parameter index.
     */
    public function testGetArgumentReturnsCorrectValueByIndex() {
        
    }
    
    /**
     * Ensures that getArgument() returns the correct value for a given parameter
     * index if a default parameter was used.
     */
    public function testGetArgumentReturnsCorrectValueByIndexIfDefaultParameterIsUsed() {
        
    }
    
    /**
     * Checks if getArgument() returns the correct value for a given
     * parameter name.
     */
    public function testGetArgumentReturnsCorrectValueByName() {
        
    }
    
    /**
     * Ensures that getArgument() returns the correct value for a given parameter
     * name if a default parameter was used.
     */
    public function testGetArgumentReturnsCorrectValueByNameIfDefaultParameterIsUsed() {
    
    }
     
    /**
     * Ensures that getArgument() throws an exception if an invalid parameter name is
     * provided.
     */
    public function testGetArgumentThrowsExceptionIfParameterWithProvidedNameDoesNotExist() {
        
    }
     
    /**
     * Checks if setArguments() provides a fluent interface.
     */
    public function testSetArgumentsProvidesFluentInterface() {
        
    }
    
    /**
     * Checks if getContext() returns the correct object.
     */
    public function testGetContextReturnsCorrectObject() {
        
    }
    
    /**
     * Ensures that getContext() returns the correct value if the class name was provided.
     */
    public function testGetContextReturnsCorrectValueIfClassNameWasProvided() {
        
    }
    
    /**
     * Ensures that getTarget() returns a callable per default.
     */
    public function testGetTargetReturnsCallablePerDefault() {
        
    }
    
    /**
     * Checks if getTarget() returns the provided callable.
     */
    public function testGetTargetReturnsCorrectCallable() {
        
    }
    
    /**
     * Checks if setTarget() provides a fluent interface.
     */
    public function testSetTargetProvidesFluentInterface() {
        
    }
    
    /**
     * Ensures that setTarget() throws an exception if no callable was provided.
     */
    public function testSetTargetThrowsExceptionIfNoCallableIsProvided() {
        
    }
    
    /**
     * This method and its parameters are used to create a join point for testing.
     *
     * @param string $name
     * @param boolean $register
     * @return AspectPHP_JoinPoint
     */
    protected function createJoinPoint($name, $register = true) {
        $arguments = func_get_args();
        $joinPoint = new AspectPHP_JoinPoint(__METHOD__, $this);
        $joinPoint->setArguments($arguments);
        return $joinPoint;
    }
    
}

?>