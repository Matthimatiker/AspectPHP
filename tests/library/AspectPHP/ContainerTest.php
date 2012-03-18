<?php

/**
 * AspectPHP_ContainerTest
 *
 * @package AspectPHP
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @since 15.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the container class.
 *
 * @package AspectPHP
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @since 15.01.2012
 */
class AspectPHP_ContainerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * The previous aspect manager.
     *
     * @var AspectPHP_Manager|null
     */
    protected $previousManager = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->storeManager();
        $this->resetManager();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->restoreManager();
        parent::tearDown();
    }
    
    /**
     * Ensures that getManager() throws an exception if no manager is available.
     */
    public function testGetManagerThrowsExceptionIfNoManagerIsAvailable()
    {
        $this->setExpectedException('BadMethodCallException');
        AspectPHP_Container::getManager();
    }
    
    /**
     * Checks if getManager() returns the provided aspect manager.
     */
    public function testGetManagerReturnsProvidedManager()
    {
        $manager = $this->createManager();
        AspectPHP_Container::setManager($manager);
        $this->assertSame($manager, AspectPHP_Container::getManager());
    }
    
    /**
     * Ensures that setManager() throws an exception if an invalid argument is passed.
     */
    public function testSetManagerThrowsExceptionIfInvalidArgumentIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        AspectPHP_Container::setManager(new stdClass());
    }
    
    /**
     * Ensures that hasManager() returns false if no aspect manager is available.
     */
    public function testHasManagerReturnsFalseIfNoManagerIsAvailable()
    {
        $this->assertFalse(AspectPHP_Container::hasManager());
    }
    
    /**
     * Ensures that hasManager() returns true if an aspect manager is available.
     */
    public function testHasManagerReturnsTrueIfManagerIsAvailable()
    {
        AspectPHP_Container::setManager($this->createManager());
        $this->assertTrue(AspectPHP_Container::hasManager());
    }
    
    /**
     * Creates an aspect manager.
     *
     * @return AspectPHP_Manager
     */
    protected function createManager()
    {
        return $this->getMock('AspectPHP_Manager');
    }
    
    /**
     * Resets the aspect manager.
     */
    protected function resetManager()
    {
        AspectPHP_Container::setManager(null);
    }
    
    /**
     * Stores the current aspect manager.
     */
    protected function storeManager()
    {
        $this->previousManager = (AspectPHP_Container::hasManager()) ? AspectPHP_Container::getManager() : null;
    }
    
    /**
     * Restores the previous aspect manager.
     */
    protected function restoreManager()
    {
        AspectPHP_Container::setManager($this->previousManager);
    }
    
}