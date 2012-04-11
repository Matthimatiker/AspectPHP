<?php

/**
 * AspectPHP_Reflection_AspectTest
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 10.04.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/** Load the aspect that is used for testing. */
require_once(dirname(__FILE__) . '/TestData/Reflection/SimpleAspect.php');

/**
 * Tests the aspect reflection implementation.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 10.04.2012
 */
class AspectPHP_Reflection_AspectTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the constructor throws an exception if the provided class
     * is not an aspect.
     */
    public function testConstructorThrowsExceptionIfProvidedClassIsNotAnAspect()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        new AspectPHP_Reflection_Aspect('ArrayObject');
    }
    
    /**
     * Ensures that the constructor throws an exception if the provided object
     * is not an aspect.
     */
    public function testConstructorThrowsExceptionIfProvidedObjectIsNotAnAspect()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        new AspectPHP_Reflection_Aspect(new ArrayObject(array()));
    }
    
    /**
     * Checks if the constructor accepts aspect classes.
     */
    public function testConstructorAcceptsAspectClass()
    {
        $this->setExpectedException(null);
        new AspectPHP_Reflection_Aspect('Reflection_SimpleAspect');
    }
    
    /**
     * Checks if the constructor accepts aspect objects.
     */
    public function testConstructorAcceptsAspectObject()
    {
        $this->setExpectedException(null);
        new AspectPHP_Reflection_Aspect(new Reflection_SimpleAspect());
    }
    
    /**
     * Checks if getPointcuts() returns an array.
     */
    public function testGetPointcutsReturnsArray()
    {
        
    }
    
    /**
     * Ensures that the array from getPointcuts() is numerical indexed.
     */
    public function testGetPointcutsReturnsNumericalIndexedArray()
    {
        
    }
    
    /**
     * Checks if the array from getPointcuts() contains only ReflectionMethod objects.
     */
    public function testGetPointcutsReturnsReflectionMethodObjects()
    {
        
    }
    
    /**
     * Checks if getPointcuts() returns the expected number of methods.
     */
    public function testGetPointcutsReturnsCorrectNumberOfMethods()
    {
        
    }
    
    /**
     * Checks if getPointcuts() returns methods that are prefixed with "pointcut"
     * but not referenced by any advice.
     */
    public function testGetPointcutsReturnsMethodsThatArePrefixedButNotReferenced()
    {
        
    }
    
    /**
     * Checks if getAdvices() returns an array.
     */
    public function testGetAdvicesReturnsArray()
    {
        
    }
    
    /**
     * Ensures that the array from getAdvices() is numerical indexed.
     */
    public function testGetAdvicesReturnsNumericalIndexedArray()
    {
    
    }
    
    /**
     * Checks if the array from getAdvices() contains only ReflectionMethod objects.
     */
    public function testGetAdvicesReturnsReflectionMethodObjects()
    {
    
    }
    
    /**
     * Checks if getAdvices() returns the expected number of methods.
     */
    public function testGetAdvicesReturnsCorrectNumberOfMethods()
    {
    
    }
    
    /**
     * Ensures that getPointcut() throws an exception if the method with the provided
     * name does not exist.
     */
    public function testGetPointcutThrowsExceptionIfNameOfNotExistingMethodIsProvided()
    {
        
    }
    
    /**
     * Ensures that getPointcut() throws an exception if the provided method is not
     * considered as pointcut.
     */
    public function testGetPointcutThrowsExceptionIfMethodIsNotConsideredAsPointcut()
    {
        
    }
    
    /**
     * Checks if getPointcut() returns a ReflectionMethod object.
     */
    public function testGetPointcutReturnsReflectionMethodObject()
    {
        
    }
    
    /**
     * Checks if getPointcut() returns the correct method.
     */
    public function testGetPointcutReturnsCorrectReflectionMethodObject()
    {
    
    }
    
    /**
     * Ensures that getAdvice() throws an exception if the method with the provided
     * name does not exist.
     */
    public function testGetAdviceThrowsExceptionIfNameOfNotExistingMethodIsProvided()
    {
    
    }
    
    /**
     * Ensures that getAdvice() throws an exception if the provided method is not
     * considered as advice.
     */
    public function testGetAdviceThrowsExceptionIfMethodIsNotConsideredAsAdvice()
    {
    
    }
    
    /**
     * Checks if getAdvice() returns a ReflectionMethod object.
     */
    public function testGetAdviceReturnsReflectionMethodObject()
    {
    
    }
    
    /**
     * Checks if getAdvice() returns the correct method.
     */
    public function testGetAdviceReturnsCorrectReflectionMethodObject()
    {
    
    }
    
    /**
     * Ensures that hasPointcut() returns false if the name of a not existing
     * method is provided.
     */
    public function testHasPointcutReturnsFalseIfNotExistingMethodIsProvided()
    {
        
    }
    
    /**
     * Ensures that hasPointcut() returns false if the provided method is not
     * considered as pointcut.
     */
    public function testHasPointcutReturnsFalseIfMethodIsNotConsideredAsPointcut()
    {
        
    }
    
    /**
     * Ensures that hasPointcut() returns true if the pointcut method exists.
     */
    public function testHasPointcutReturnsTrueIfPointcutExists()
    {
        
    }
    
    /**
     * Ensures that hasAdvice() returns false if the name of a not existing
     * method is provided.
     */
    public function testHasAdviceReturnsFalseIfNotExistingMethodIsProvided()
    {
    
    }
    
    /**
     * Ensures that hasAdvice() returns false if the provided method is not
     * considered as advice.
     */
    public function testHasAdviceReturnsFalseIfMethodIsNotConsideredAsAdvice()
    {
    
    }
    
    /**
     * Ensures that hasAdvice() returns true if the advice method exists.
     */
    public function testHasAdviceReturnsTrueIfAdviceExists()
    {
    
    }
    
    /**
     * Creates a reflection aspect for the provided aspect
     * object or class.
     *
     * @param mixed $classOrAspect
     * @return AspectPHP_Reflection_Aspect
     */
    protected function createReflection($classOrAspect)
    {
        return new AspectPHP_Reflection_Aspect($classOrAspect);
    }
    
}