<?php

/**
 * AspectPHP_Pointcut_NoneTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the None pointcut.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.03.2012
 */
class AspectPHP_Pointcut_NoneTest extends PHPUnit_Framework_TestCase
{
    
	/**
     * System under test.
     *
     * @var AspectPHP_Pointcut_None
     */
    protected $pointcut = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $this->pointcut = new AspectPHP_Pointcut_None();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->pointcut = null;
        parent::tearDown();
    }
    
	/**
     * Checks if the class implements the AspectPHP_Pointcut interface.
     */
    public function testPointcutImplementsInterface() {
        $this->assertInstanceOf('AspectPHP_Pointcut', $this->pointcut);
    }
    
    /**
     * Checks if matches() returns a boolean value.
     */
    public function testMatchesReturnsBoolean() {
        $this->assertInternalType('boolean', $this->pointcut->matches(__METHOD__));
    }
    
    /**
     * Ensures that matches() returns false.
     */
    public function testMatchesReturnsFalse() {
        $this->assertFalse($this->pointcut->matches(__METHOD__));
    }
    
}