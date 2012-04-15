<?php

/**
 * AspectPHP_Reflection_PointcutTest
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the pointcut reflection object.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_PointcutTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the constructor accepts the name of an aspect class.
     */
    public function testConstructorAcceptsAspectName()
    {
        
    }
    
    /**
     * Ensures that the constructor accepts an aspect object.
     */
    public function testConstructorAcceptsAspectObject()
    {
    
    }
    
    /**
     * Ensures that the constructor accepts an aspect reflection object.
     */
    public function testConstructorAcceptsAspectReflection()
    {
    
    }
    
    /**
     * Ensures that the constructor throws an exception if the name of a class
     * that is not an aspect is provided.
     */
    public function testConstructorThrowsExceptionIfInvalidClassNameIsProvided()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if a non-aspect object
     * is provided.
     */
    public function testConstructorThrowsExceptionIfInvalidObjectIsProvided()
    {
    
    }
    
    /**
     * Ensures that an exception is thrown if the provided method is not public.
     */
    public function testConstructorThrowsExceptionIfPointcutIsNotPublic()
    {
        
    }
    
    /**
     * Ensures that an exception is thrown if the provided method requires parameters.
     */
    public function testConstructorThrowsExceptionIfPointcutRequiresParameters()
    {
    
    }
    
    /**
     * Checks if getAspect() returns an aspect reflection object.
     */
    public function testGetAspectReturnsReflectionObject()
    {
        
    }
    
    /**
     * Ensures that getAspect() returns the aspect reflection object that was provided
     * to the constructor.
     */
    public function testGetAspectReturnsObjectThatWasPassedToConstructor()
    {
        
    }
    
    /**
     * Ensures that createPointcut() throws an exception if the pointcut method does not
     * return a pointcut object.
     */
    public function testCreatePointcutThrowsExceptionIfMethodDoesNotReturnPointcutObject()
    {
        
    }
    
    /**
     * Checks if createPointcut() returns a pointcut object.
     */
    public function testCreatePointcutReturnsPointcutObject()
    {
        
    }
    
    /**
     * Ensures that createPointcut() returns different pointcut objects if different
     * aspect instances are provided.
     */
    public function testCreatePointcutReturnsDifferentPointcutsForDifferentAspects()
    {
        
    }
    
    /**
     * Ensures that createPointcut() returns the same object if the same aspect
     * object is provided again.
     */
    public function testCreatePointcutReturnsSamePointcutForSameAspect()
    {
        
    }
    
}