<?php

/**
 * AspectPHP_Advice_TypeTest
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.05.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the class that is responsible for type handling.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.05.2012
 */
class AspectPHP_Advice_TypeTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that isValid() accepts a valid type.
     */
    public function testIsValidAcceptsValidType()
    {
        $this->assertTrue(AspectPHP_Advice_Type::isValid(AspectPHP_Advice_Type::BEFORE));
    }
    
    /**
     * Checks if isValid() rejects an invalid type.
     */
    public function testIsValidRejectsInvalidType()
    {
        $this->assertFalse(AspectPHP_Advice_Type::isValid('invalid'));
    }
    
    /**
     * Ensures that assertValid() does not throw an exception if the
     * provided type is valid.
     */
    public function testAssertValidDoesNotThrowExceptionIfTypeIsValid()
    {
        $this->setExpectedException(null);
        AspectPHP_Advice_Type::assertValid(AspectPHP_Advice_Type::AFTER);
    }
    
    /**
     * Ensures that assertValid() throws an exception if an invalid type
     * is provided.
     */
    public function testAssertValidThrowsExceptionIfInvalidTypeIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        AspectPHP_Advice_Type::assertValid('invalid');
    }
    
    /**
     * Checks if all() returns an array.
     */
    public function testAllReturnsArray()
    {
        $types = AspectPHP_Advice_Type::all();
        $this->assertInternalType('array', $types);
    }
    
    /**
     * Checks if the array that is returned by all() contains
     * all available types.
     */
    public function testAllReturnsAllAvailableTypes()
    {
        $types = AspectPHP_Advice_Type::all();
        $this->assertInternalType('array', $types);
        $this->assertContains(AspectPHP_Advice_Type::BEFORE, $types);
        $this->assertContains(AspectPHP_Advice_Type::AFTER_RETURNING, $types);
        $this->assertContains(AspectPHP_Advice_Type::AFTER_THROWING, $types);
        $this->assertContains(AspectPHP_Advice_Type::AFTER, $types);
    }
    
    /**
     * Checks if each call to all() returns the same result.
     *
     * Ensures that mechanisms like caching do not influence the correctness
     * of the method.
     */
    public function testEachCallReturnsSameResult()
    {
        $this->assertEquals(AspectPHP_Advice_Type::all(), AspectPHP_Advice_Type::all());
    }
    
}