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
    
    /**
     * Ensures that the constructor throws an exception if the provided class
     * is not an aspect.
     */
    public function testConstructorThrowsExceptionIfProvidedClassIsNotAnAspect()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('ArrayObject');
    }
    
    /**
     * Ensures that the constructor throws an exception if the provided object
     * is not an aspect.
     */
    public function testConstructorThrowsExceptionIfProvidedObjectIsNotAnAspect()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection(new ArrayObject(array()));
    }
    
    /**
     * Checks if the constructor accepts aspect classes.
     */
    public function testConstructorAcceptsAspectClass()
    {
        $this->setExpectedException(null);
        $this->createReflection('Reflection_SimpleAspect');
    }
    
    /**
     * Checks if the constructor accepts aspect objects.
     */
    public function testConstructorAcceptsAspectObject()
    {
        $this->setExpectedException(null);
        $this->createReflection($this->getMock('AspectPHP_Aspect'));
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
     * Ensures that each call to getPointcut() returns the same object (if the
     * arguments are the same).
     */
    public function testGetPointcutReturnsSameObjectForEachCall()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect');
        $first      = $reflection->getPointcut('pointcutOne');
        $second     = $reflection->getPointcut('pointcutOne');
        $this->assertSame($first, $second);
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
     * Ensures that each call to getAdvice() returns the same object (if the
     * arguments are the same).
     */
    public function testGetAdviceReturnsSameObjectForEachCall()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect');
        $first      = $reflection->getAdvice('beforeAdvice');
        $second     = $reflection->getAdvice('beforeAdvice');
        $this->assertSame($first, $second);
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
     * Ensures that getPointcuts() returns the correct number of pointcut methods, even if a
     * pointcut is referenced by multiple advices.
     */
    public function testGetPointcutsReturnsCorrectNumberOfMethodsEvenIfPointcutIsReferencedMultipleTimes()
    {
        $pointcuts = $this->createReflection('Reflection_MultiplePointcutReferencesAspect')->getPointcuts();
        $this->assertEquals(1, count($pointcuts));
    }
    
    /**
     * Checks if the reflection class is able to handle methods without doc block.
     */
    public function testAspectReflectionSkipsMethodsWithoutDocBlock()
    {
        $this->setExpectedException(null);
        $this->createReflection('Reflection_NoDocBlockAspect');
    }
    
    /**
     * Ensures that an exception is thrown if a referenced pointcut does not exist.
     */
    public function testAspectReflectionThrowsExceptionIfReferencedPointcutDoesNotExist()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_PointcutMissingAspect');
    }
    
    /**
     * Ensures that an exception is thrown if an advice tag is used but no pointcut
     * is specified.
     */
    public function testAspectReflectionThrowsExceptionIfTagWithoutPointcutInformationIsUsed()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_NoPointcutReferenceAspect');
    }
    
    /**
     * Ensures that the reflection class skips internal methods of AspectPHP.
     *
     * Internal methods are the ones that are weaved into classes. Aspects may
     * contain internal methods if the aspect class was accidentially compiled.
     */
    public function testAspectReflectionSkipsInternalMethods()
    {
        $this->setExpectedException(null);
        $this->createReflection('Reflection_InternalMethodAspect');
    }
    
    /**
     * Ensures that an exception is thrown if a pointcut method is not public.
     */
    public function testAspectReflectionThrowsExceptionIfPointcutIsNotPublic()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_PointcutNotPublicAspect');
    }
    
    /**
     * Ensures that an exception is thrown if an advice method is not public.
     */
    public function testAspectReflectionThrowsExceptionIfAdviceIsNotPublic()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_AdviceNotPublicAspect');
    }
    
    /**
     * Checks if the reflection class accepts pointcut references without optional
     * braces that indicate the usage of a method.
     */
    public function testAspectReflectionAcceptsPointcutReferencesWithoutBraces()
    {
        $this->setExpectedException(null);
        $this->createReflection('Reflection_ReferenceWithoutBracesAspect');
    }
    
    /**
     * Ensures that the reflection class throws an exception if a pointcut method
     * requires a parameter.
     */
    public function testAspectReflectionThrowsExceptionIfPointcutRequiresParameters()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_PointcutWithParameterAspect');
    }
    
    /**
     * Ensures that the reflection class throws an exception if an advice method
     * requires more than one parameter.
     */
    public function testAspectReflectionThrowsExceptionIfAdviceRequiresMoreThanOneParameter()
    {
        $this->markTestIncomplete();
    }
    
    /**
     * Checks if the reflection class accepts advices with a single (join point)
     * parameter.
     */
    public function testAspectReflectionAcceptsAdviceWithSingleParameter()
    {
        $this->markTestIncomplete();
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
        if (is_string($classOrAspect)) {
            $this->loadIfNecessary($classOrAspect);
        }
        return new AspectPHP_Reflection_Aspect($classOrAspect);
    }
    
    /**
     * Loads the provided test class if it is not already available.
     *
     * @param string $class
     */
    protected function loadIfNecessary($class)
    {
        if (class_exists($class, false)) {
            // Class is already loaded.
            return;
        }
        $pathSegment = str_replace('_', '/', $class);
        require_once(dirname(__FILE__) . '/TestData/'. $pathSegment . '.php');
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