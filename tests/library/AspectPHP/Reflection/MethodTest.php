<?php

/**
 * AspectPHP_Reflection_MethodTest
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
 * Tests the aspect method reflection class.
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
class AspectPHP_Reflection_MethodTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the constructor accepts the name of an aspect class.
     */
    public function testConstructorAcceptsAspectName()
    {
        $this->setExpectedException(null);
        $this->createReflection('Reflection_SimpleAspect', 'anotherMethod');
    }
    
    /**
     * Ensures that the constructor accepts an aspect object.
     */
    public function testConstructorAcceptsAspectObject()
    {
        $this->setExpectedException(null);
        $this->loadIfNecessary('Reflection_SimpleAspect');
        $aspect = new Reflection_SimpleAspect();
        $this->createReflection($aspect, 'anotherMethod');
    }
    
    /**
     * Ensures that the constructor accepts an aspect reflection object.
     */
    public function testConstructorAcceptsAspectReflection()
    {
        $this->setExpectedException(null);
        $this->loadIfNecessary('Reflection_SimpleAspect');
        $reflection = new AspectPHP_Reflection_Aspect('Reflection_SimpleAspect');
        $this->createReflection($reflection, 'anotherMethod');
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
     * Checks if getAspect() returns an aspect reflection object.
     */
    public function testGetAspectReturnsReflectionObject()
    {
        $aspect = $this->createReflection('Reflection_SimpleAspect', 'anotherMethod')->getAspect();
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
        $aspect     = $this->createReflection($reflection, 'anotherMethod')->getAspect();
        $this->assertSame($reflection, $aspect);
    }
    
    /**
     * Ensures that getDocComment() returns false if no comment is available.
     */
    public function testGetDocCommentReturnsFalseIfNoCommentIsAvailable()
    {
        $method = $this->createReflection('Reflection_NoDocBlockAspect', 'notDocumentedMethod');
        $this->assertFalse($method->getDocComment());
    }
    
    /**
     * Checks if getDocComment() returns an object of type AspectPHP_Reflection_DocComment.
     */
    public function testGetDocCommentReturnsCommentObject()
    {
        $method = $this->createReflection('Reflection_SimpleAspect', 'anotherMethod');
        $this->assertInstanceOf('AspectPHP_Reflection_DocComment', $method->getDocComment());
    }
    
    /**
     * Ensures that each call to getDocComment() returns the same object.
     */
    public function testEachCallToGetDocCommentReturnsSameObject()
    {
        $method = $this->createReflection('Reflection_SimpleAspect', 'anotherMethod');
        $this->assertSame($method->getDocComment(), $method->getDocComment());
    }
    
    /**
     * Ensures that hasDocComment() returns false if no doc block is available.
     */
    public function testHasDocCommentReturnsFalseIfCommentIsNotAvailable()
    {
        
    }
    
    /**
     * Ensures that hasDocComment() returns true if the method has a doc block.
     */
    public function testHasDocCommentReturnsTrueIfCommentIsAvailable()
    {
        
    }
    
    /**
     * Creates a reflection object for the method.
     *
     * @param mixed $classOrAspect
     * @param string $name The name of the method.
     * @return AspectPHP_Reflection_Method
     */
    protected function createReflection($classOrAspect, $name)
    {
        if (is_string($classOrAspect)) {
            $this->loadIfNecessary($classOrAspect);
        }
        return new AspectPHP_Reflection_Method($classOrAspect, $name);
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