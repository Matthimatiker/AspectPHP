<?php

/**
 * AspectPHP_Pointcut_RegExpTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');
/**
 * Tests the regular expression pointcut.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */
class AspectPHP_Pointcut_RegExpTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if the class implements the AspectPHP_Pointcut interface.
     */
    public function testPointcutImplementsInterface()
    {
        $pointcut = new AspectPHP_Pointcut_RegExp('ABC.*');
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
    }
    
    /**
     * Ensures that the constructor throws an exception if an empty string
     * is provided.
     */
    public function testConstructorThrowsExceptionIfEmptyStringIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new AspectPHP_Pointcut_RegExp('');
    }
    
    /**
     * Ensures that the constructor throws an exception if no string is provided.
     */
    public function testConstructorThrowsExceptionIfNoStringIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        new AspectPHP_Pointcut_RegExp(new stdClass());
    }
    
    /**
     * Checks if matches() returns a boolean value.
     */
    public function testMatchesReturnsBoolean()
    {
        $this->assertInternalType('boolean', $this->create('.*')->matches(__METHOD__));
    }
    
    /**
     * Ensures that matches() returns true if the expression matches
     * the provided method.
     */
    public function testMatchesReturnsTrueIfExpressionMatchesMethod()
    {
        $this->assertMatches(__CLASS__ . '::.*', __METHOD__);
    }
    
    /**
     * Ensures that matches() returns false if the expression does not match
     * the provided method.
     */
    public function testMatchesReturnsFalseIfExpressionDoesNotMatchMethod()
    {
        $this->assertNotMatches('AnotherClass::.*', __METHOD__);
    }
    
    /**
     * Ensures that matches() returns true if the expression matches a method
     * whose class uses a namespace.
     */
    public function testMatchesReturnsTrueIfExpressionMatchesNamespacedClass()
    {
        $this->assertMatches('Demo\Package\.*::show', 'Demo\Package\MyClass::show');
    }
    
    /**
     * Ensures that matches() returns false if the expression does not match a method
     * whose class uses a namespace.
     */
    public function testMatchesReturnsTrueIfExpressionDoesNotMatchNamespacedClass()
    {
        $this->assertNotMatches('Demo\Package\.*::show', 'Demo\AnotherPackage\MyClass::show');
    }
    
    /**
     * Asserts that the given expression matches the provided method.
     *
     * @param string $expression
     * @param string $method
     */
    protected function assertMatches($expression, $method)
    {
        $message = '"' . $expression . '" does not match "' . $method . '".';
        $this->assertTrue($this->create($expression)->matches($method), $message);
    }
    
    /**
     * Asserts that the given expression does not match the provided method.
     *
     * @param string $expression
     * @param string $method
     */
    protected function assertNotMatches($expression, $method)
    {
        $message = '"' . $expression . '" matches "' . $method . '".';
        $this->assertFalse($this->create($expression)->matches($method), $message);
    }
    
    /**
     * Uses the given expression to create a pointcut.
     *
     * @param string $expression
     * @return AspectPHP_Pointcut_RegExp
     */
    protected function create($expression)
    {
        return new AspectPHP_Pointcut_RegExp($expression);
    }
    
}