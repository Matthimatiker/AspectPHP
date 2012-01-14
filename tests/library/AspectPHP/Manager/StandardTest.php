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
    protected function setUp() {
        parent::setUp();
        $this->manager = new AspectPHP_Manager_Standard();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->manager = null;
        parent::tearDown();
    }
    
    public function testGetAspectsReturnsArray() {
        
    }
    
    public function testGetAspectsReturnsRegisteredAspects() {
        
    }
    
    public function testUnregisterRemovesGivenAspect() {
        
    }
    
    public function testUnregisterDoesNothingIfTheGivenAspectIsNotRegistered() {
        
    }
    
    public function testGetAspectsForReturnsArray() {
        
    }
    
    public function testGetAspectsForDoesNotReturnAspectsThatAreNotRegisteredForTheProvidedMethod() {
        
    }
    
    public function testGetAspectsForReturnsAspectsThatAreRegisteredForTheProvidedMethod() {
        
    }
    
}

?>