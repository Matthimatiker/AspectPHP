<?php

/**
 * AspectPHP_Reflection_AdviceTest
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.04.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the advice reflection class.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.04.2012
 */
class AspectPHP_Reflection_AdviceTest extends PHPUnit_Framework_TestCase
{
    
    public function testConstructorThrowsExceptionIfAdviceIsNotPublic()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfMoreThanOneParameterIsRequired()
    {
        
    }
    
    public function testConstructorAcceptsAdviceWithOneParameter()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfMethodDoesNotProvideDocComment()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfDocCommentContainsTagWithoutPointcutReference()
    {
        
    }
    
    public function testConstructorThrowsExceptionIfMethodDoesNotReferenceAnyPointcuts()
    {
        
    }
    
    public function testGetPointcutsByTypeReturnsArray()
    {
        
    }
    
    public function testGetPointcutsByTypeReturnsPointcutReflectionObjects()
    {
        
    }
    
    public function testGetPointcutsByTypeReturnsCorrectNumberOfPointcuts()
    {
        
    }
    
    public function testGetPointcutsByTypeReturnsEmptyArrayIfNoPointcutOfThatTypeWasReferenced()
    {
        
    }
    
    public function testGetPointcutsByTypeThrowsExceptionIfInvalidTypeIsProvided()
    {
        
    }
    
}