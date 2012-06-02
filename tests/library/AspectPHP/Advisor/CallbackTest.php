<?php

/**
 * AspectPHP_Advice_Callback
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the callback advice implementation.
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */
class AspectPHP_Advisor_CallbackTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Name of the callback method that is used for testing.
     *
     * @var string
     */
    const CALLBACK_NAME = 'callback';
    
    /**
     * Checks if the class implements the advice interface.
     */
    public function testAdviceImplementsInterface()
    {
        $callback = $this->createCallbackObject();
        $advice   = new AspectPHP_Advice_Callback($this->createPointcut(), $this->toCallback($callback));
        $this->assertInstanceOf('AspectPHP_Advice', $advice);
    }
    
    /**
     * Ensures that the constructor throws an exception if an invalid
     * callback argument is provided.
     */
    public function testAdviceThrowsExceptionIfInvalidCallbackIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new AspectPHP_Advice_Callback($this->createPointcut(), null);
    }
    
    /**
     * Ensures that the constructor throws an exception if the provided
     * callback seems valid, but it is not callable (for example if the
     * callback references a private method).
     */
    public function testAdviceThrowsExceptionIfProvidedCallbackIsNotCallable()
    {
        $this->setExpectedException('InvalidArgumentException');
        // The createPointcut() method is protected and cannot be called by the advice object.
        new AspectPHP_Advice_Callback($this->createPointcut(), array($this, 'createPointcut'));
    }
    
    /**
     * Checks if invoke() calls the callback method.
     */
    public function testAdviceInvokesCallbackMethod()
    {
        $callback = $this->createCallbackObject();
        $callback->expects($this->once())
                 ->method(self::CALLBACK_NAME);
        $advice = new AspectPHP_Advice_Callback($this->createPointcut(), $this->toCallback($callback));
        $advice->invoke($this->createJoinPoint());
    }
    
    /**
     * Ensures that invoke() passes the provided join point
     * to the callback method.
     */
    public function testAdvicePassesJoinPointToCallbackMethod()
    {
        $callback = $this->createCallbackObject();
        $callback->expects($this->any())
                 ->method(self::CALLBACK_NAME)
                 ->with($this->isInstanceOf('AspectPHP_JoinPoint'));
        $advice = new AspectPHP_Advice_Callback($this->createPointcut(), $this->toCallback($callback));
        $advice->invoke($this->createJoinPoint());
    }
    
    /**
     * Checks if getPointcut() returns the pointcut object that
     * was provided during construction.
     */
    public function testGetPointcutReturnsProvidedPointcut()
    {
        $pointcut = $this->createPointcut();
        $advice   = new AspectPHP_Advice_Callback($pointcut, $this->toCallback($this->createCallbackObject()));
        $this->assertSame($pointcut, $advice->getPointcut());
    }
    
    /**
     * Creates a pointcut for testing.
     *
     * @return AspectPHP_Pointcut
     */
    protected function createPointcut()
    {
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * Creates a mock object whose callback() method
     * may be used to check method calls.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createCallbackObject()
    {
        $mock = $this->getMock('stdClass', array(self::CALLBACK_NAME));
        $mock->expects($this->any())
             ->method(self::CALLBACK_NAME)
             ->will($this->returnValue(null));
        return $mock;
    }
    
    /**
     * Returns a callback identifier for the given callback object
     * that was created by createCallbackObject().
     *
     * @param PHPUnit_Framework_MockObject_MockObject $callbackObject
     * @return array(mixed)
     */
    protected function toCallback($callbackObject)
    {
        return array($callbackObject, self::CALLBACK_NAME);
    }
    
    /**
     * Creates a join point object for testing.
     *
     * @return AspectPHP_JoinPoint
     */
    protected function createJoinPoint()
    {
        return new AspectPHP_JoinPoint(__FUNCTION__, $this);
    }
    
}