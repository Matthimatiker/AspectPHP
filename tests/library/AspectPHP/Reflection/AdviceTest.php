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
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_AdviceNotPublicAspect', 'protectedBeforeAdvice');
    }
    
    /**
     * Ensures that the constructor throws an exception if the advice method
     * requires more than one parameter.
     */
    public function testConstructorThrowsExceptionIfMoreThanOneParameterIsRequired()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_AdviceWithTooManyParamsAspect', 'afterAdvice');
    }
    
    /**
     * Checks if the constructor accepts an advice method that requires one parameter.
     */
    public function testConstructorAcceptsAdviceWithOneParameter()
    {
        $this->setExpectedException(null);
        $this->createReflection('Reflection_AdviceWithJoinPointParamAspect', 'afterAdvice');
    }
    
    /**
     * Ensures that the constructor throws an exception if the passed method does
     * not provide a doc comment.
     */
    public function testConstructorThrowsExceptionIfMethodDoesNotProvideDocComment()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_NoDocBlockAspect', 'notDocumentedMethod');
    }
    
    /**
     * Ensures that the constructor throws an exception if the doc comment contains a
     * type tag without information about the referenced pointcut.
     */
    public function testConstructorThrowsExceptionIfDocCommentContainsTagWithoutPointcutReference()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_NoPointcutReferenceAspect', 'noValidReference');
    }
    
    /**
     * Ensures that the constructor throws an exception if the doc comment of the method
     * does not reference any pointcut.
     */
    public function testConstructorThrowsExceptionIfMethodDoesNotReferenceAnyPointcuts()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $this->createReflection('Reflection_SimpleAspect', 'anotherMethod');
    }
    
    /**
     * Checks if getPointcutsByType() returns an array.
     */
    public function testGetPointcutsByTypeReturnsArray()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'beforeAdvice');
        $pointcuts  = $reflection->getPointcutsByType('before');
        $this->assertInternalType('array', $pointcuts);
    }
    
    /**
     * Checks if the array that is returned by getPointcutsByType() contains only
     * objects of type AspectPHP_Reflection_Pointcut.
     */
    public function testGetPointcutsByTypeReturnsPointcutReflectionObjects()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'beforeAdvice');
        $pointcuts  = $reflection->getPointcutsByType('before');
        $this->assertInternalType('array', $pointcuts);
        $this->assertContainsOnly('AspectPHP_Reflection_Pointcut', $pointcuts);
    }
    
    /**
     * Checks if getPointcutsByType() returns the correct number of pointcuts.
     */
    public function testGetPointcutsByTypeReturnsCorrectNumberOfPointcuts()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'beforeAdvice');
        $pointcuts  = $reflection->getPointcutsByType('before');
        $this->assertInternalType('array', $pointcuts);
        $this->assertEquals(1, count($pointcuts));
    }
    
    /**
     * Ensures that getPointcutsByType() returns an empty array no pointcut is referenced
     * for the provided type.
     */
    public function testGetPointcutsByTypeReturnsEmptyArrayIfNoPointcutOfThatTypeWasReferenced()
    {
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'beforeAdvice');
        $pointcuts  = $reflection->getPointcutsByType('after');
        $this->assertInternalType('array', $pointcuts);
        $this->assertEquals(0, count($pointcuts));
    }
    
    /**
     * Ensures that getPointcutsByType() throws an exception id an invalid type is passed.
     */
    public function testGetPointcutsByTypeThrowsExceptionIfInvalidTypeIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $reflection = $this->createReflection('Reflection_SimpleAspect', 'beforeAdvice');
        $reflection->getPointcutsByType('invalid');
    }
    
    /**
     * Ensures that getPointcutsByType() throws an exception if a referenced pointcut
     * is not declared in the corresponding aspect.
     */
    public function testGetPointcutsByTypeThrowsExceptionIfReferencedPointcutDoesNotExist()
    {
        $this->setExpectedException('AspectPHP_Reflection_Exception');
        $reflection = $this->createReflection('Reflection_PointcutMissingAspect', 'beforeAdvice');
        $reflection->getPointcutsByType('before');
    }
    
    /**
     * Ensures that containsAdviceAnnotation() returns true if the comment references a pointcut.
     */
    public function testContainsAdviceAnnotationReturnsTrueIfCommentContainsPointcutReference()
    {
        
    }
    
    public function testContainsAdviceAnnotationReturnsFalseIfCommentDoesNotContainPointcutReference()
    {
        
    }
    
    /**
     * Creates a reflection object for the advice.
     *
     * @param mixed $classOrAspect
     * @param string $name The name of the advice method.
     * @return AspectPHP_Reflection_Advice
     */
    protected function createReflection($classOrAspect, $name)
    {
        if (is_string($classOrAspect)) {
            $this->loadIfNecessary($classOrAspect);
        }
        return new AspectPHP_Reflection_Advice($classOrAspect, $name);
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