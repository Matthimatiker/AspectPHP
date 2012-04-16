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
    
    /**
     * Ensures that the constructor throws an exception if the advice method
     * is not public.
     */
    public function testConstructorThrowsExceptionIfAdviceIsNotPublic()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if the advice method
     * requires more than one parameter.
     */
    public function testConstructorThrowsExceptionIfMoreThanOneParameterIsRequired()
    {
        
    }
    
    /**
     * Checks if the constructor accepts an advice method that requires one parameter.
     */
    public function testConstructorAcceptsAdviceWithOneParameter()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if the passed method does
     * not provide a doc comment.
     */
    public function testConstructorThrowsExceptionIfMethodDoesNotProvideDocComment()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if the doc comment contains a
     * type tag without information about the referenced pointcut.
     */
    public function testConstructorThrowsExceptionIfDocCommentContainsTagWithoutPointcutReference()
    {
        
    }
    
    /**
     * Ensures that the constructor throws an exception if the doc comment of the method
     * does not reference any poimtcut.
     */
    public function testConstructorThrowsExceptionIfMethodDoesNotReferenceAnyPointcuts()
    {
        
    }
    
    /**
     * Checks if getPointcutsByType() returns an array.
     */
    public function testGetPointcutsByTypeReturnsArray()
    {
        
    }
    
    /**
     * Checks if the array that is returned ny getPointcutsByType() contains only
     * objects of type AspectPHP_Reflection_Pointcut.
     */
    public function testGetPointcutsByTypeReturnsPointcutReflectionObjects()
    {
        
    }
    
    /**
     * Checks if getPointcutsByType() returns the correct number of pointcuts.
     */
    public function testGetPointcutsByTypeReturnsCorrectNumberOfPointcuts()
    {
        
    }
    
    /**
     * Ensures that getPointcutsByType() returns an empty array no pointcut is referenced
     * for the provided type.
     */
    public function testGetPointcutsByTypeReturnsEmptyArrayIfNoPointcutOfThatTypeWasReferenced()
    {
        
    }
    
    /**
     * Ensures that getPointcutsByType() throws an exception id an invalid type is passed.
     */
    public function testGetPointcutsByTypeThrowsExceptionIfInvalidTypeIsProvided()
    {
        
    }
    
    /**
     * Ensures that getPointcutsByType() throws an exception if a referenced pointcut
     * is not declared in the corresponding aspect.
     */
    public function testGetPointcutsByTypeThrowsExceptionIfReferencedPointcutDoesNotExist()
    {
        
    }
    
}