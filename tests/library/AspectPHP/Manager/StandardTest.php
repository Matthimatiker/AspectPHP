<?php

/**
 * AspectPHP_Manager_StandardTest
 *
 * @category PHP
 * @package AspectPHP_Manager
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 13.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/** Load the aspect that is used for testing. */
require_once(dirname(__FILE__) . '/TestData/Standard/SimpleAspect.php');

/**
 * Tests the default aspect manager.
 *
 * @category PHP
 * @package AspectPHP_Manager
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 13.01.2012
 */
class AspectPHP_Manager_StandardTest extends PHPUnit_Framework_TestCase
{
    
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
        $this->manager->register($first);
        $this->manager->register($second);
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
        $this->manager->register($aspect);
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
     * Checks if getAdvicesFor() returns an advice container.
     */
    public function testGetAdvicesForReturnsContainer()
    {
        $advices = $this->manager->getAdvicesFor(__METHOD__);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
    }
    
    /**
     * Ensures that getAdvicesFor() returns an empty container if no advice is registered
     * for the given method.
     */
    public function testGetAdvicesForReturnsEmptyContainerIfNoAdviceIsRegisteredForMethod()
    {
        $this->manager->register($this->createAspect());
        $advices = $this->manager->getAdvicesFor(__METHOD__);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $this->assertEquals(0, count($advices));
    }
    
    /**
     * Ensures that getAdvicesFor() does not return advices that are not registered for the
     * given method.
     */
    public function testGetAdvicesForDoesNotReturnAdvicesThatAreNotRegisteredForTheProvidedMethod()
    {
        $this->markTestIncomplete();
    }
    
    /**
     * Ensures that getAdvicesFor() returns advices that are registered for the provided method.
     */
    public function testGetAdvicesForReturnsAdvicesThatAreRegisteredForTheProvidedMethod()
    {
        $this->markTestIncomplete();
    }
    
    /**
     * Creates an aspect mock.
     *
     * @return AspectPHP_Aspect
     */
    protected function createAspect()
    {
        return new Standard_SimpleAspect();
    }
    
}