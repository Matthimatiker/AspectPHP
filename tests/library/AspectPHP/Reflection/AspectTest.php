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

/** Load an aspect that is used for testing. */
require_once(dirname(__FILE__) . '/TestData/Reflection/SimpleAspect.php');
/** Load an aspect that is used for testing. */
require_once(dirname(__FILE__) . '/TestData/Reflection/UnreferencedPointcutAspect.php');

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
        $pointcuts = $this->createReflection('Reflection_SimpleAspect')->getPointcuts();
        $this->assertInternalType('array', $pointcuts);
    }
    
    /**
     * Ensures that the array from getPointcuts() is numerical indexed.
     */
    public function testGetPointcutsReturnsNumericalIndexedArray()
    {
        $pointcuts = $this->createReflection('Reflection_SimpleAspect')->getPointcuts();
        $this->assertInternalType('array', $pointcuts);
        $this->assertContainsOnly('integer', array_keys($pointcuts));
    }
    
    /**
     * Checks if the array from getPointcuts() contains only ReflectionMethod objects.
     */
    public function testGetPointcutsReturnsReflectionMethodObjects()
    {
        $pointcuts = $this->createReflection('Reflection_SimpleAspect')->getPointcuts();
        $this->assertInternalType('array', $pointcuts);
        $this->assertContainsOnly('ReflectionMethod', $pointcuts);
    }
    
    /**
     * Checks if getPointcuts() returns the expected number of methods.
     */
    public function testGetPointcutsReturnsCorrectNumberOfMethods()
    {
        $pointcuts = $this->createReflection('Reflection_SimpleAspect')->getPointcuts();
        $this->assertInternalType('array', $pointcuts);
        $this->assertEquals(2, count($pointcuts));
    }
    
    /**
     * Checks if getPointcuts() returns methods that are prefixed with "pointcut"
     * but not referenced by any advice.
     */
    public function testGetPointcutsReturnsMethodsThatArePrefixedButNotReferenced()
    {
        $pointcuts = $this->createReflection('Reflection_UnreferencedPointcutAspect')->getPointcuts();
        $names     = $this->getMethodNames($pointcuts);
        $this->assertContains('pointcutUnreferencedPointcut', $names);
    }
    
    /**
     * Checks if getAdvices() returns an array.
     */
    public function testGetAdvicesReturnsArray()
    {
        $advices = $this->createReflection('Reflection_SimpleAspect')->getAdvices();
        $this->assertInternalType('array', $advices);
    }
    
    /**
     * Ensures that the array from getAdvices() is numerical indexed.
     */
    public function testGetAdvicesReturnsNumericalIndexedArray()
    {
        $advices = $this->createReflection('Reflection_SimpleAspect')->getAdvices();
        $this->assertInternalType('array', $advices);
        $this->assertContainsOnly('integer', array_keys($advices));
    }
    
    /**
     * Checks if the array from getAdvices() contains only ReflectionMethod objects.
     */
    public function testGetAdvicesReturnsReflectionMethodObjects()
    {
        $advices = $this->createReflection('Reflection_SimpleAspect')->getAdvices();
        $this->assertInternalType('array', $advices);
        $this->assertContainsOnly('ReflectionMethod', $advices);
    }
    
    /**
     * Checks if getAdvices() returns the expected number of methods.
     */
    public function testGetAdvicesReturnsCorrectNumberOfMethods()
    {
        $advices = $this->createReflection('Reflection_SimpleAspect')->getAdvices();
        $this->assertInternalType('array', $advices);
        $this->assertEquals(2, count($advices));
    }
    
    /**
     * Ensures that getPointcut() throws an exception if the method with the provided
     * name does not exist.
     */
    public function testGetPointcutThrowsExceptionIfNameOfNotExistingMethodIsProvided()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_SimpleAspect')->getPointcut('missing');
    }
    
    /**
     * Ensures that getPointcut() throws an exception if the provided method is not
     * considered as pointcut.
     */
    public function testGetPointcutThrowsExceptionIfMethodIsNotConsideredAsPointcut()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_SimpleAspect')->getPointcut('anotherMethod');
    }
    
    /**
     * Checks if getPointcut() returns a ReflectionMethod object.
     */
    public function testGetPointcutReturnsReflectionMethodObject()
    {
        $pointcut = $this->createReflection('Reflection_SimpleAspect')->getPointcut('pointcutOne');
        $this->assertInstanceOf('ReflectionMethod', $pointcut);
    }
    
    /**
     * Checks if getPointcut() returns the correct method.
     */
    public function testGetPointcutReturnsCorrectReflectionMethodObject()
    {
        $pointcut = $this->createReflection('Reflection_SimpleAspect')->getPointcut('pointcutOne');
        $this->assertInstanceOf('ReflectionMethod', $pointcut);
        $this->assertEquals('pointcutOne', $pointcut->getName());
    }
    
    /**
     * Ensures that getAdvice() throws an exception if the method with the provided
     * name does not exist.
     */
    public function testGetAdviceThrowsExceptionIfNameOfNotExistingMethodIsProvided()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_SimpleAspect')->getAdvice('missing');
    }
    
    /**
     * Ensures that getAdvice() throws an exception if the provided method is not
     * considered as advice.
     */
    public function testGetAdviceThrowsExceptionIfMethodIsNotConsideredAsAdvice()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_SimpleAspect')->getAdvice('anotherMethod');
    }
    
    /**
     * Checks if getAdvice() returns a ReflectionMethod object.
     */
    public function testGetAdviceReturnsReflectionMethodObject()
    {
        $advice = $this->createReflection('Reflection_SimpleAspect')->getAdvice('beforeAdvice');
        $this->assertInstanceOf('ReflectionMethod', $advice);
    }
    
    /**
     * Checks if getAdvice() returns the correct method.
     */
    public function testGetAdviceReturnsCorrectReflectionMethodObject()
    {
        $advice = $this->createReflection('Reflection_SimpleAspect')->getAdvice('beforeAdvice');
        $this->assertInstanceOf('ReflectionMethod', $advice);
        $this->assertEquals('beforeAdvice', $advice->getName());
    }
    
    /**
     * Ensures that hasPointcut() returns false if the name of a not existing
     * method is provided.
     */
    public function testHasPointcutReturnsFalseIfNotExistingMethodIsProvided()
    {
        $exists = $this->createReflection('Reflection_SimpleAspect')->hasPointcut('missing');
        $this->assertFalse($exists);
    }
    
    /**
     * Ensures that hasPointcut() returns false if the provided method is not
     * considered as pointcut.
     */
    public function testHasPointcutReturnsFalseIfMethodIsNotConsideredAsPointcut()
    {
        $exists = $this->createReflection('Reflection_SimpleAspect')->hasPointcut('anotherMethod');
        $this->assertFalse($exists);
    }
    
    /**
     * Ensures that hasPointcut() returns true if the pointcut method exists.
     */
    public function testHasPointcutReturnsTrueIfPointcutExists()
    {
        $exists = $this->createReflection('Reflection_SimpleAspect')->hasPointcut('pointcutTwo');
        $this->assertTrue($exists);
    }
    
    /**
     * Ensures that hasAdvice() returns false if the name of a not existing
     * method is provided.
     */
    public function testHasAdviceReturnsFalseIfNotExistingMethodIsProvided()
    {
        $exists = $this->createReflection('Reflection_SimpleAspect')->hasAdvice('missing');
        $this->assertFalse($exists);
    }
    
    /**
     * Ensures that hasAdvice() returns false if the provided method is not
     * considered as advice.
     */
    public function testHasAdviceReturnsFalseIfMethodIsNotConsideredAsAdvice()
    {
        $exists = $this->createReflection('Reflection_SimpleAspect')->hasAdvice('anotherMethod');
        $this->assertFalse($exists);
    }
    
    /**
     * Ensures that hasAdvice() returns true if the advice method exists.
     */
    public function testHasAdviceReturnsTrueIfAdviceExists()
    {
        $exists = $this->createReflection('Reflection_SimpleAspect')->hasAdvice('afterAdvice');
        $this->assertTrue($exists);
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
    
    /**
     * Accepts an array of ReflectionMethod objects and returns the names
     * of the contained methods as strings.
     *
     * @param array(ReflectionMethod)|mixed $methods
     * @return array(string) The method names.
     */
    protected function getMethodNames($methods)
    {
        $this->assertInternalType('array', $methods);
        $this->assertContainsOnly('ReflectionMethod', $methods);
        $names = array();
        foreach ($methods as $method) {
            /* @var $method ReflectionMethod */
            $names[] = $method->getName();
        }
        return $names;
    }
    
}