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
        $this->assertInstanceOf('AspectPHP_Pointcut', $this->advice->getPointcut());
    }
    
    /**
     * Ensures that getPointcut() returns a pointcut that does not match
     * if no advice was added.
     */
    public function testPointcutDoesNotMatchIfNoAdviceWasAdded()
    {
        $pointcut = $this->advice->getPointcut();
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
        $this->assertFalse($pointcut->matches(__METHOD__));
    }
    
    /**
     * Ensures that invoke() does nothing if no advice was added.
     */
    public function testInvokeDoesNothingIfNoAdviceWasAdded()
    {
        $this->setExpectedException(null);
        $this->advice->invoke($this->createJoinPoint());
    }
    
    /**
     * Checks if add() provides a fluent interface.
     */
    public function testAddProvidesFluentInterface()
    {
        $innerAdvice = $this->createAdvice(new AspectPHP_Pointcut_None());
        $this->assertSame($this->advice, $this->advice->add($innerAdvice));
    }
    
    /**
     * Ensures that invoke() calls the invoke() method of all
     * added advices.
     */
    public function testInvokeCallsAllAddedAdvices()
    {
        $firstAdvice = $this->createAdvice(new AspectPHP_Pointcut_None());
        $firstAdvice->expects($this->once())
                    ->method('invoke');
        $secondAdvice = $this->createAdvice(new AspectPHP_Pointcut_None());
        $secondAdvice->expects($this->once())
                     ->method('invoke');
        $this->advice->add($firstAdvice);
        $this->advice->add($secondAdvice);
        $this->advice->invoke($this->createJoinPoint());
    }
    
    /**
     * Checks if the composite implements the Countable interface.
     */
    public function testCompositeImplementsCountable()
    {
        $this->assertInstanceOf('Countable', $this->advice);
    }
    
    /**
     * Ensures that count() returns 0 if no advice was added.
     */
    public function testCountReturnsZeroIfNoAdviceWasAdded()
    {
        $this->assertEquals(0, $this->advice->count());
    }
    
    /**
     * Checks if count() returns the number of registered advices.
     */
    public function testCountReturnsNumberOfAddedAdvices()
    {
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_None()));
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_None()));
        $this->assertEquals(2, $this->advice->count());
    }
    
    /**
     * Ensures that the pointcut that is provided by getPointcut() matches
     * if the pointcuts of all added advices match.
     */
    public function testPointcutMatchesIfAllInnerAdvicePointcutsMatch()
    {
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_All()));
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_All()));
        $pointcut = $this->advice->getPointcut();
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
        $this->assertTrue($pointcut->matches(__METHOD__));
    }
    
    /**
     * Ensures that the pointcut that is provided by getPointcut() does not match
     * if at least one of the inner advice pointcuts does not match.
     */
    public function testPointcutDoesNotMatchIfOneInnerAdvicePointcutDoesNotMatch()
    {
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_All()));
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_None()));
        $pointcut = $this->advice->getPointcut();
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
        $this->assertFalse($pointcut->matches(__METHOD__));
    }
    
    /**
     * Checks if merge() provides a fluent interface.
     */
    public function testMergeProvidesFluentInterface()
    {
        $anotherComposite = new AspectPHP_Advice_Composite();
        $this->assertSame($this->advice, $this->advice->merge($anotherComposite));
    }
    
    /**
     * Ensures that merge() adds all advices from the given composite.
     */
    public function testMergeAddsAllAdvicesFromProvidedComposite()
    {
        $anotherComposite = new AspectPHP_Advice_Composite();
        $anotherComposite->add($this->createAdvice(new AspectPHP_Pointcut_All()));
        $this->advice->add($this->createAdvice(new AspectPHP_Pointcut_All()));
        $this->advice->merge($anotherComposite);
        $this->assertEquals(2, $this->advice->count());
    }
    
    public function testCompositeIsTraversable()
    {
        
    }
    
    public function testIterationReturnsNothingIfNoAdviceWasAdded()
    {
    
    }
    
    public function testIterationReturnsOnlyAdvices()
    {
        
    }
    
    public function testIterationReturnsAddedAdvices()
    {
        
    }
    
    /**
     * Creates a mocked advice for testing.
     *
     * @param AspectPHP_Pointcut $pointcut
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createAdvice(AspectPHP_Pointcut $pointcut)
    {
        $mock = $this->getMock('AspectPHP_Advice');
        $mock->expects($this->any())
             ->method('getPointcut')
             ->will($this->returnValue($pointcut));
        return $mock;
    }
    
    /**
     * Creates a join point for testing.
     *
     * @return AspectPHP_JoinPoint
     */
    protected function createJoinPoint()
    {
        return new AspectPHP_JoinPoint(__FUNCTION__, $this);
    }
    
}