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
        $this->setExpectedException(null);
        $this->createReflection('Reflection_SimpleAspect', 'pointcutOne');
    }
    
    /**
     * Ensures that the constructor accepts an aspect object.
     */
    public function testConstructorAcceptsAspectObject()
    {
        $this->setExpectedException(null);
        $this->loadIfNecessary('Reflection_SimpleAspect');
        $aspect = new Reflection_SimpleAspect();
        $this->createReflection($aspect, 'pointcutOne');
    }
    
    /**
     * Ensures that the constructor accepts an aspect reflection object.
     */
    public function testConstructorAcceptsAspectReflection()
    {
        $this->setExpectedException(null);
        $this->loadIfNecessary('Reflection_SimpleAspect');
        $reflection = new AspectPHP_Reflection_Aspect('Reflection_SimpleAspect');
        $this->createReflection($reflection, 'pointcutOne');
    }
    
    /**
     * Ensures that the constructor throws an exception if the name of a class
     * that is not an aspect is provided.
     */
    public function testConstructorThrowsExceptionIfInvalidClassNameIsProvided()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('ArrayObject', 'count');
    }
    
    /**
     * Ensures that the constructor throws an exception if a non-aspect object
     * is provided.
     */
    public function testConstructorThrowsExceptionIfInvalidObjectIsProvided()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection(new ArrayObject(array()), 'count');
    }
    
    /**
     * Ensures that an exception is thrown if the provided method is not public.
     */
    public function testConstructorThrowsExceptionIfPointcutIsNotPublic()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_PointcutNotPublicAspect', 'protectedPointcut');
    }
    
    /**
     * Ensures that an exception is thrown if the provided method requires parameters.
     */
    public function testConstructorThrowsExceptionIfPointcutRequiresParameters()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_PointcutWithParameterAspect', 'pointcut');
    }
    
    /**
     * Checks if getAspect() returns an aspect reflection object.
     */
    public function testGetAspectReturnsReflectionObject()
    {
        $aspect = $this->createReflection('Reflection_SimpleAspect', 'pointcutOne')->getAspect();
        $this->assertInstanceOf('AspectPHP_Reflection_Aspect', $aspect);
    }
    
    /**
     * Ensures that getAspect() returns the aspect reflection object that was provided
     * to the constructor.
     */
    public function testGetAspectReturnsObjectThatWasPassedToConstructor()
    {
        $this->loadIfNecessary('Reflection_SimpleAspect');
        $reflection = new AspectPHP_Reflection_Aspect('Reflection_SimpleAspect');
        $aspect     = $this->createReflection($reflection, 'pointcutOne')->getAspect();
        $this->assertSame($reflection, $aspect);
    }
    
    /**
     * Ensures that createPointcut() throws an exception if the pointcut method does not
     * return a pointcut object.
     */
    public function testCreatePointcutThrowsExceptionIfMethodDoesNotReturnPointcutObject()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $reflection = $this->createReflection('Reflection_InvalidPointcutReturnValueAspect', 'pointcutInvalid');
        $reflection->createPointcut(new Reflection_InvalidPointcutReturnValueAspect());
    }
    
    /**
     * Checks if createPointcut() returns a pointcut object.
     */
    public function testCreatePointcutReturnsPointcutObject()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'pointcutOne');
        $aspect     = new Reflection_SimpleAspect();
        $pointcut   = $reflection->createPointcut($aspect);
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
    }
    
    /**
     * Ensures that createPointcut() returns different pointcut objects if different
     * aspect instances are provided.
     */
    public function testCreatePointcutReturnsDifferentPointcutsForDifferentAspects()
    {
        $reflection    = $this->createReflection('Reflection_SimpleAspect', 'pointcutOne');
        $aspect        = new Reflection_SimpleAspect();
        $anotherAspect = new Reflection_SimpleAspect();
        $this->assertNotSame($reflection->createPointcut($aspect), $reflection->createPointcut($anotherAspect));
    }
    
    /**
     * Ensures that createPointcut() returns the same object if the same aspect
     * object is provided again.
     */
    public function testCreatePointcutReturnsSamePointcutForSameAspect()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'pointcutOne');
        $aspect     = new Reflection_SimpleAspect();
        $pointcut   = $reflection->createPointcut($aspect);
        $this->assertSame($pointcut, $reflection->createPointcut($aspect));
    }
    
    /**
     * Creates a reflection object for the pointcut.
     *
     * @param mixed $classOrAspect
     * @param string $name The name of the pointcut method.
     * @return AspectPHP_Reflection_Pointcut
     */
    protected function createReflection($classOrAspect, $name)
    {
        if (is_string($classOrAspect)) {
            $this->loadIfNecessary($classOrAspect);
        }
        return new AspectPHP_Reflection_Pointcut($classOrAspect, $name);
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
    
}