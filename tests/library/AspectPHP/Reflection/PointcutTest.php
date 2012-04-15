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
    
    public function testConstructorAcceptsAspectName()
    {
        
    }
    
    public function testConstructorAcceptsAspectObject()
    {
    
    }
    
    public function testConstructorAcceptsAspectReflection()
    {
    
    }
    
    public function testConstructorThrowsExceptionIfInvalidClassNameIsProvided()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfInvalidObjectIsProvided()
    {
    
    }
    
    public function testConstructorThrowsExceptionIfPointcutIsNotPublic()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfPointcutRequiresParameters()
    {
    
    }
    
    public function testGetAspectReturnsReflectionObject()
    {
        
    }
    
    public function testGetAspectReturnsObjectThatWasPassedToConstructor()
    {
        
    }
    
    public function testCreatePointcutThrowsExceptionIfMethodDoesNotReturnPointcutObject()
    {
        
    }
    
    public function testCreatePointcutReturnsPointcutObject()
    {
        
    }
    
    public function testCreatePointcutReturnsDifferentPointcutsForDifferentAspects()
    {
        
    }
    
    public function testCreatePointcutReturnsSamePointcutForSameAspect()
    {
        
    }
    
}