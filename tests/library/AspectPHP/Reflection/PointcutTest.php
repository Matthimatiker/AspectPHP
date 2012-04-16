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