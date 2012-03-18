<?php

/**
 * AspectPHP_JoinPointTest
 *
 * @category PHP
 * @package AspectPHP
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 08.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the JoinPoint implementation.
 *
 * @category PHP
 * @package AspectPHP
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 08.01.2012
 */
class AspectPHP_JoinPointTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_JoinPoint
     */
    protected $joinPoint = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->joinPoint = $this->createJoinPoint('Bert', false);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->joinPoint = null;
        parent::tearDown();
    }
    
    /**
     * Checks if getClass() returns the name of the class that contains the method.
     */
    public function testGetClassReturnsCorrectValue()
    {
        $this->assertEquals(__CLASS__, $this->joinPoint->getClass());
    }
    
    /**
     * Checks if getMethod() returns the name of the method.
     */
    public function testGetMethodReturnsCorrectValue()
    {
        $this->assertEquals('createJoinPoint', $this->joinPoint->getMethod());
    }
    
    /**
     * Ensures that getReturnValue() returns null if no value was provided.
     */
    public function testGetReturnValueReturnsNullIfNoValueWasProvided()
    {
        $this->assertNull($this->joinPoint->getReturnValue());
    }
    
    /**
     * Checks if getReturnsValue() returns the correct value.
     */
    public function testGetReturnValueReturnsCorrectValue()
    {
        $this->joinPoint->setReturnValue('Test');
        $this->assertEquals('Test', $this->joinPoint->getReturnValue());
    }
    
    /**
     * Checks if setReturnsValue() provides a fluent interface.
     */
    public function testSetReturnValueProvidesFluentInterface()
    {
        $this->assertSame($this->joinPoint, $this->joinPoint->setReturnValue('Demo'));
    }
    
    /**
     * Ensures that getException() returns null if no exception was provided.
     */
    public function testGetExceptionReturnsNullIfNoExceptionWasProvided()
    {
        $this->assertNull($this->joinPoint->getException());
    }
    
    /**
     * Checks if getException() returns the correct exception object.
     */
    public function testGetExceptionReturnsCorrectObject()
    {
        $exception = new RuntimeException('Exception test.');
        $this->joinPoint->setException($exception);
        $this->assertSame($exception, $this->joinPoint->getException());
    }
    
    /**
     * Ensures that setException() accepts null.
     */
    public function testSetExceptionAcceptsNull()
    {
        $this->joinPoint->setException(new RuntimeException('Test.'));
        $this->joinPoint->setException(null);
        $this->assertNull($this->joinPoint->getException());
    }
    
    /**
     * Ensures that setException() throws an exception if an invalid argument
     * is passed.
     */
    public function testSetExceptionThrowsExceptionIfInvalidArgumentIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->joinPoint->setException(new stdClass());
    }
    
    /**
     * Checks if setException() provides a fluent interface.
     */
    public function testSetExceptionProvidesFluentInterface()
    {
        $this->assertSame($this->joinPoint, $this->joinPoint->setException(new RuntimeException('Test')));
    }
    
    /**
     * Checks if getArguments() returns an array.
     */
    public function testGetArgumentsReturnsArray()
    {
        $arguments = $this->joinPoint->getArguments();
        $this->assertInternalType('array', $arguments);
    }
    
    /**
     * Ensures that getArguments() returns correct values.
     */
    public function testGetArgumentsReturnsCorrectValues()
    {
        $arguments = $this->joinPoint->getArguments();
        $this->assertEquals(array('Bert', false), $arguments);
    }
    
    /**
     * Ensures that getArguments() returns the correct values if a default
     * parameter was used when the method was called.
     */
    public function testGetArgumentsReturnsCorrectValuesIfDefaultParameterIsUsed()
    {
        $joinPoint = $this->createJoinPoint('Ernie');
        $arguments = $joinPoint->getArguments();
        $this->assertEquals(array('Ernie', true), $arguments);
    }
    
    /**
     * Ensures that getArguments() returns also parameters that were not explicitly declared.
     */
    public function testGetArgumentsReturnsCorrectValuesIfVariableParametersAreAdded()
    {
        $joinPoint = $this->createJoinPoint('Ernie', false, 1, 2, 3);
        $arguments = $joinPoint->getArguments();
        $expected  = array('Ernie', false, 1, 2, 3);
        $this->assertEquals($expected, $arguments);
    }
    
    /**
     * Checks if getArgument() returns the correct value for a given
     * parameter index.
     */
    public function testGetArgumentReturnsCorrectValueByIndex()
    {
        $this->assertEquals('Bert', $this->joinPoint->getArgument(0));
    }
    
    /**
     * Ensures that getArgument() returns the correct value for a given parameter
     * index if a default parameter was used.
     */
    public function testGetArgumentReturnsCorrectValueByIndexIfDefaultParameterIsUsed()
    {
         $joinPoint = $this->createJoinPoint('Ernie');
         $this->assertEquals(true, $joinPoint->getArgument(1));
    }
    
    /**
     * Checks if getArgument() returns the correct value for a given
     * parameter name.
     */
    public function testGetArgumentReturnsCorrectValueByName()
    {
        $this->assertEquals('Bert', $this->joinPoint->getArgument('name'));
    }
    
    /**
     * Ensures that getArgument() returns the correct value for a given parameter
     * name if a default parameter was used.
     */
    public function testGetArgumentReturnsCorrectValueByNameIfDefaultParameterIsUsed()
    {
        $joinPoint = $this->createJoinPoint('Ernie');
        $this->assertEquals(true, $joinPoint->getArgument('register'));
    }
    
    /**
     * Ensures that getArgument() throws an exception if an invalid parameter index is
     * provided.
     */
    public function testGetArgumentThrowsExceptionIfParameterWithProvidedIndexDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->joinPoint->getArgument(2);
    }
    
    /**
     * Ensures that getArgument() throws an exception if an invalid parameter name is
     * provided.
     */
    public function testGetArgumentThrowsExceptionIfParameterWithProvidedNameDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->joinPoint->getArgument('missing');
    }
     
    /**
     * Checks if setArguments() provides a fluent interface.
     */
    public function testSetArgumentsProvidesFluentInterface()
    {
        $this->assertSame($this->joinPoint, $this->joinPoint->setArguments(array()));
    }
    
    /**
     * Checks if getContext() returns the correct object.
     */
    public function testGetContextReturnsCorrectObject()
    {
        $this->assertSame($this, $this->joinPoint->getContext());
    }
    
    /**
     * Ensures that getContext() returns the correct value if the class name was provided.
     */
    public function testGetContextReturnsCorrectValueIfClassNameWasProvided()
    {
        $joinPoint = new AspectPHP_JoinPoint(__FUNCTION__, __CLASS__);
        $this->assertEquals(__CLASS__, $joinPoint->getContext());
    }
    
    /**
     * Ensures that getTarget() returns a callable per default.
     */
    public function testGetTargetReturnsCallablePerDefault()
    {
        $this->assertTrue(is_callable($this->joinPoint->getTarget()));
    }
    
    /**
     * Checks if getTarget() returns the provided callable.
     */
    public function testGetTargetReturnsCorrectCallable()
    {
        $callable = 'trim';
        $this->joinPoint->setTarget($callable);
        $this->assertSame($callable, $this->joinPoint->getTarget());
    }
    
    /**
     * Checks if setTarget() provides a fluent interface.
     */
    public function testSetTargetProvidesFluentInterface()
    {
        $callable = array($this, 'createJoinPoint');
        $this->assertSame($this->joinPoint, $this->joinPoint->setTarget($callable));
    }
    
    /**
     * Ensures that setTarget() throws an exception if no callable was provided.
     */
    public function testSetTargetThrowsExceptionIfNoCallableIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->joinPoint->setTarget(new stdClass());
    }
    
    /**
     * This method and its parameters are used to create a join point for testing.
     *
     * @param string $name
     * @param boolean $register
     * @return AspectPHP_JoinPoint
     */
    protected function createJoinPoint($name, $register = true)
    {
        $arguments = func_get_args();
        $joinPoint = new AspectPHP_JoinPoint(__FUNCTION__, $this);
        $joinPoint->setArguments($arguments);
        return $joinPoint;
    }
    
}