<?php

/**
 * AspectPHP_Advice_Callback
 *
 * @category PHP
 * @package AspectPHP_Advice
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
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */
class AspectPHP_Advice_CallbackTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if the class implements the advice interface.
     */
    public function testAdviceImplementsInterface()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if an invalid
     * callback argument is provided.
     */
    public function testAdviceThrowsExceptionIfInvalidCallbackIsProvided()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if the provided
     * callback seems valid, but it is not callable (for example if the
     * callback references a private method).
     */
    public function testAdviceThrowsExceptionIfProvidedCallbackIsNotCallable()
    {
        
    }
    
    /**
     * Checks if invoke() calls the callback method.
     */
    public function testAdviceInvokesCallbackMethod()
    {
        
    }
    
    /**
     * Ensures that invoke() passes the provided join point
     * to the callback method.
     */
    public function testAdvicePassesJoinPointToCallbackMethod()
    {
        
    }
    
    /**
     * Checks if getPointcut() returns the pointcut object that
     * was provided during construction.
     */
    public function testGetPointcutReturnsProvidedPointcut()
    {
        
    }
    
}