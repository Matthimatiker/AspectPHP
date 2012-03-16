<?php

/**
 * AspectPHP_Manager_StandardTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Manager
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 13.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the default aspect manager.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Manager
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 13.01.2012
 */
class AspectPHP_Manager_StandardTest extends PHPUnit_Framework_TestCase {
    
    /**
     * System under test.
     *
     * @var AspectPHP_Manager_Standard
     */
    protected $manager = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->manager = new AspectPHP_Manager_Standard();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->manager = null;
        parent::tearDown();
    }
    
    /**
     * Checks if getAspects() returns an array.
     */
    public function testGetAspectsReturnsArray()
    {
        $aspects = $this->manager->getAspects();
        $this->assertInternalType('array', $aspects);
    }
    
    /**
     * Ensures that getAspects() returns the registered aspects.
     */
    public function testGetAspectsReturnsRegisteredAspects()
    {
        $first  = $this->createAspect();
        $second = $this->createAspect();
        $this->manager->register($first, __METHOD__);
        $this->manager->register($second, __CLASS__ . '::setUp');
        $aspects = $this->manager->getAspects();
        $this->assertInternalType('array', $aspects);
        $this->assertContains($first, $aspects, 'Missing first aspect.');
        $this->assertContains($second, $aspects, 'Missing second aspect.');
    }
    
    /**
     * Checks if unregister() removes a registered aspect.
     */
    public function testUnregisterRemovesGivenAspect()
    {
        $aspect = $this->createAspect();
        $this->manager->register($aspect, __METHOD__);
        $this->manager->unregister($aspect);
        $aspects = $this->manager->getAspects();
        $this->assertInternalType('array', $aspects);
        $this->assertEquals(0, count($aspects));
    }
    
    /**
     * Ensures that unregister() does nothing if the given aspect is not registered.
     */
    public function testUnregisterDoesNothingIfTheGivenAspectIsNotRegistered()
    {
        $this->setExpectedException(null);
        $aspect = $this->createAspect();
        $this->manager->unregister($aspect);
    }
    
    /**
     * Checks if getAspectsFor() returns an array.
     */
    public function testGetAspectsForReturnsArray()
    {
        $aspects = $this->manager->getAspectsFor(__METHOD__);
        $this->assertInternalType('array', $aspects);
    }
    
    /**
     * Ensures that getAspectsFor() returns an empty array if no aspected is registered
     * for the given method.
     */
    public function testGetAspectsForReturnsEmptyArrayIfNoAspectIsRegisteredForMethod()
    {
        $this->manager->register($this->createAspect(), __CLASS__ . '::a');
        $aspects = $this->manager->getAspectsFor(__METHOD__);
        $this->assertInternalType('array', $aspects);
        $this->assertEquals(0, count($aspects));
    }
    
    /**
     * Ensures that getAspectsFor() does not return aspects that are not registered for the
     * given method.
     */
    public function testGetAspectsForDoesNotReturnAspectsThatAreNotRegisteredForTheProvidedMethod()
    {
        $aspect = $this->createAspect();
        $this->manager->register($this->createAspect(), __CLASS__ . '::a');
        $this->manager->register($aspect, __CLASS__ . '::b');
        $aspects = $this->manager->getAspectsFor(__CLASS__ . '::a');
        $this->assertInternalType('array', $aspects);
        $this->assertNotContains($aspect, $aspects);
    }
    
    /**
     * Ensures that getAspectsFor() returns aspects that are registered for the provided method.
     */
    public function testGetAspectsForReturnsAspectsThatAreRegisteredForTheProvidedMethod()
    {
        $aspect = $this->createAspect();
        $this->manager->register($this->createAspect(), __CLASS__ . '::a');
        $this->manager->register($aspect, __CLASS__ . '::b');
        $aspects = $this->manager->getAspectsFor(__CLASS__ . '::b');
        $this->assertInternalType('array', $aspects);
        $this->assertContains($aspect, $aspects);
    }
    
    /**
     * Creates an aspect mock.
     *
     * @return AspectPHP_Aspect
     */
    protected function createAspect()
    {
       return $this->getMock('AspectPHP_Aspect');
    }
    
}