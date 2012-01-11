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
    
    // get class correct
    public function testGetClassReturnsCorrectValue() {
        
    }
    
    // get method correct
    public function testGetMethodReturnsCorrectValue() {
        
    }
    
    // return value is null if not set
    public function testGetReturnValueReturnsNullIfNoValueWasProvided() {
        
    }
    
    // return value correct
    public function testGetReturnValueReturnsCorrectValue() {
        
    }
    
    // set return value fluent interface
    public function testSetReturnValueProvidesFluentInterface() {
        
    }
    
    // exception null if not set
    public function testGetExceptionReturnsNullIfNoExceptionWasProvided() {
        
    }
    
    // exception correct
    public function testGetExceptionReturnsCorrectObject() {
        
    }
    
    // set exception accepts null
    public function testSetExceptionAcceptsNull() {
        
    }
    
    // set exception fluent interface
    public function testSetExceptionProvidesFluentInterface() {
        
    }
    
    // get arguments array
    public function testGetArgumentsReturnsArray() {
        
    }
    
    // get arguments correct
    public function testGetArgumentsReturnsCorrectValues() {
        
    }
    
    // get arguments correct if default value
    public function testGetArgumentsReturnsCorrectValuesIfDefaultParameterIsUsed() {
        
    }
    
    // get argument by index correct
    public function testGetArgumentReturnsCorrectValueByIndex() {
        
    }
    
    // get argument by index correct if default value
    public function testGetArgumentReturnsCorrectValueByIndexIfDefaultParameterIsUsed() {
        
    }
    
    // get argument by name correct
    public function testGetArgumentReturnsCorrectValueByName() {
        
    }
    
    // get argument by name correct if default value
    public function testGetArgumentReturnsCorrectValueByNameIfDefaultParameterIsUsed() {
    
    }
     
    public function testGetArgumentThrowsExceptionIfParameterWithProvidedNameDoesNotExist() {
        
    }
     
    // set arguments fluent interface
    public function testSetArgumentsProvidesFluentInterface() {
        
    }
    
    // context correct if object
    public function testGetContextReturnsCorrectObject() {
        
    }
    
    // context correct if string
    public function testGetContextReturnsCorrectValueIfClassNameWasProvided() {
        
    }
    
    // default target correct
    public function testGetTargetReturnsCallablePerDefault() {
        
    }
    
    // provided target correct
    public function testGetTargetReturnsCorrectCallable() {
        
    }
    
    // set target fluent interface
    public function testSetTargetProvidesFluentInterface() {
        
    }
    
    // set target throws exception if invalid callback
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