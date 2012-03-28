<?php

/**
 * AspectPHP_Advice_CompositeTest
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the composite advice.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */
class AspectPHP_Advice_CompositeTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Advice_Composite
     */
    protected $advice = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->advice = new AspectPHP_Advice_Composite();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->advice = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the advice implements the AspectPHP_Advice interface.
     */
    public function testImplementsAdviceInterface()
    {
        $this->assertInstanceOf('AspectPHP_Advice', $this->advice);
    }
    
    /**
     * Ensures that getPointcut() returns a pointcut object even if no advice
     * was added.
     */
    public function testGetPointcutReturnsPointcutObjectEvenIfNoAdviceWasAdded()
    {
        
    }
    
    /**
     * Ensures that invoke() does nothing if no advice was added.
     */
    public function testInvokeDoesNothingIfNoAdviceWasAdded()
    {
        
    }
    
    /**
     * Checks if add() provides a fluent interface.
     */
    public function testAddProvidesFluentInterface()
    {
    
    }
    
    /**
     * Ensures that invoke() calls the invoke() method of all
     * added advices.
     */
    public function testInvokeCallsAllAddedAdvices()
    {
        
    }
    
    /**
     * Checks if the composite implements the Countable interface.
     */
    public function testCompositeImplementsCountable()
    {
        
    }
    
    /**
     * Ensures that count() returns 0 if no advice was added.
     */
    public function testCountReturnsZeroIfNoAdviceWasAdded()
    {
        
    }
    
    /**
     * Checks if count() returns the number of registered advices.
     */
    public function testCountReturnsNumberOfAddedAdvices()
    {
        
    }
    
    /**
     * Ensures that the pointcut that is provided by getPointcut() matches
     * if the pointcuts of all added advices match.
     */
    public function testPointcutMatchesIfAllInnerAdvicePointcutsMatch()
    {
        
    }
    
    /**
     * Ensures that the pointcut that is provided by getPointcut() does not match
     * if at least one of the inner advice pointcuts does not match.
     */
    public function testointcutDoesNotMatchIfOneInnerAdvicePointcutDoesNotMatch()
    {
        
    }
    
}