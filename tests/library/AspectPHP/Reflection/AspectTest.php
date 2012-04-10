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
    
    public function testConstructorThrowsExceptionIfProvidedClassIsNotAnAspect()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfProvidedObjectIsNotAnAspect()
    {
        
    }
    
    public function testConstructorAcceptsAspectClass()
    {
        
    }
    
    public function testConstructorAcceptsAspectObject()
    {
        
    }
    
    public function testGetPointcutsReturnsArray()
    {
        
    }
    
    public function testGetPointcutsReturnsNumericalIndexedArray()
    {
        
    }
    
    public function testGetPointcutsReturnsReflectionMethodObjects()
    {
        
    }
    
    public function testGetPointcutsReturnsCorrectNumberOfMethods()
    {
        
    }
    
    public function testGetAdvicesReturnsArray()
    {
        
    }
    
    public function testGetAdvicesReturnsNumericalIndexedArray()
    {
    
    }
    
    public function testGetAdvicesReturnsReflectionMethodObjects()
    {
    
    }
    
    public function testGetAdvicesReturnsCorrectNumberOfMethods()
    {
    
    }
    
    public function testGetPointcutThrowsExceptionIfNameOfNotExistingMethodIsProvided()
    {
        
    }
    
    public function testGetPointcutThrowsExceptionIfMethodIsNotConsideredAsPointcut()
    {
        
    }
    
    public function testGetPointcutReturnsReflectionMethodObject()
    {
        
    }
    
    public function testGetPointcutReturnsCorrectReflectionMethodObject()
    {
    
    }
    
    public function testGetAdviceThrowsExceptionIfNameOfNotExistingMethodIsProvided()
    {
    
    }
    
    public function testGetAdviceThrowsExceptionIfMethodIsNotConsideredAsAdvice()
    {
    
    }
    
    public function testGetAdviceReturnsReflectionMethodObject()
    {
    
    }
    
    public function testGetAdviceReturnsCorrectReflectionMethodObject()
    {
    
    }
    
    public function testHasPointcutReturnsFalseIfNotExistingMethodIsProvided()
    {
        
    }
    
    public function testHasPointcutReturnsFalseIfMethodIsNotConsideredAsPointcut()
    {
        
    }
    
    public function testHasPointcutReturnsTrueIfPointcutExists()
    {
        
    }
    
    public function testHasAdviceReturnsFalseIfNotExistingMethodIsProvided()
    {
    
    }
    
    public function testHasAdviceReturnsFalseIfMethodIsNotConsideredAsAdvice()
    {
    
    }
    
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