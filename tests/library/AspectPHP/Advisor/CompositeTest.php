<?php

/**
 * AspectPHP_Advisor_CompositeTest
 *
 * @category PHP
 * @package AspectPHP_Advisor
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
 * Tests the composite advisor.
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */
class AspectPHP_Advisor_CompositeTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Advisor_Composite
     */
    protected $advisor = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->advisor = new AspectPHP_Advisor_Composite();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->advisor = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the advisor implements the AspectPHP_Advisor interface.
     */
    public function testImplementsAdvisorInterface()
    {
        $this->assertInstanceOf('AspectPHP_Advisor', $this->advisor);
    }
    
    /**
     * Ensures that getPointcut() returns a pointcut object even if no advisor
     * was added.
     */
    public function testGetPointcutReturnsPointcutObjectEvenIfNoAdvisorWasAdded()
    {
        $this->assertInstanceOf('AspectPHP_Pointcut', $this->advisor->getPointcut());
    }
    
    /**
     * Ensures that getPointcut() returns a pointcut that does not match
     * if no advisor was added.
     */
    public function testPointcutDoesNotMatchIfNoAdvisorWasAdded()
    {
        $pointcut = $this->advisor->getPointcut();
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
        $this->assertFalse($pointcut->matches(__METHOD__));
    }
    
    /**
     * Ensures that invoke() does nothing if no advisor was added.
     */
    public function testInvokeDoesNothingIfNoAdvisorWasAdded()
    {
        $this->setExpectedException(null);
        $this->advisor->invoke($this->createJoinPoint());
    }
    
    /**
     * Checks if add() provides a fluent interface.
     */
    public function testAddProvidesFluentInterface()
    {
        $innerAdvisor = $this->createAdvisor(new AspectPHP_Pointcut_None());
        $this->assertSame($this->advisor, $this->advisor->add($innerAdvisor));
    }
    
    /**
     * Ensures that invoke() calls the invoke() method of all
     * added advisors.
     */
    public function testInvokeCallsAllAddedAdvisors()
    {
        $firstAdvisor = $this->createAdvisor(new AspectPHP_Pointcut_None());
        $firstAdvisor->expects($this->once())
                     ->method('invoke');
        $secondAdvisor = $this->createAdvisor(new AspectPHP_Pointcut_None());
        $secondAdvisor->expects($this->once())
                      ->method('invoke');
        $this->advisor->add($firstAdvisor);
        $this->advisor->add($secondAdvisor);
        $this->advisor->invoke($this->createJoinPoint());
    }
    
    /**
     * Checks if the composite implements the Countable interface.
     */
    public function testCompositeImplementsCountable()
    {
        $this->assertInstanceOf('Countable', $this->advisor);
    }
    
    /**
     * Ensures that count() returns 0 if no advisor was added.
     */
    public function testCountReturnsZeroIfNoAdvisorWasAdded()
    {
        $this->assertEquals(0, $this->advisor->count());
    }
    
    /**
     * Checks if count() returns the number of registered advisors.
     */
    public function testCountReturnsNumberOfAddedAdvisors()
    {
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_None()));
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_None()));
        $this->assertEquals(2, $this->advisor->count());
    }
    
    /**
     * Ensures that the pointcut that is provided by getPointcut() matches
     * if the pointcuts of all added advisors match.
     */
    public function testPointcutMatchesIfAllInnerAdvisorsPointcutsMatch()
    {
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_All()));
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_All()));
        $pointcut = $this->advisor->getPointcut();
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
        $this->assertTrue($pointcut->matches(__METHOD__));
    }
    
    /**
     * Ensures that the pointcut that is provided by getPointcut() does not match
     * if at least one of the inner advisor pointcuts does not match.
     */
    public function testPointcutDoesNotMatchIfOneInnerAdvisorPointcutDoesNotMatch()
    {
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_All()));
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_None()));
        $pointcut = $this->advisor->getPointcut();
        $this->assertInstanceOf('AspectPHP_Pointcut', $pointcut);
        $this->assertFalse($pointcut->matches(__METHOD__));
    }
    
    /**
     * Checks if merge() provides a fluent interface.
     */
    public function testMergeProvidesFluentInterface()
    {
        $anotherComposite = new AspectPHP_Advisor_Composite();
        $this->assertSame($this->advisor, $this->advisor->merge($anotherComposite));
    }
    
    /**
     * Ensures that merge() adds all advisors from the given composite.
     */
    public function testMergeAddsAllAdvisorsFromProvidedComposite()
    {
        $anotherComposite = new AspectPHP_Advisor_Composite();
        $anotherComposite->add($this->createAdvisor(new AspectPHP_Pointcut_All()));
        $this->advisor->add($this->createAdvisor(new AspectPHP_Pointcut_All()));
        $this->advisor->merge($anotherComposite);
        $this->assertEquals(2, $this->advisor->count());
    }
    
    /**
     * Checks if the composite is traversable.
     */
    public function testCompositeIsTraversable()
    {
        $this->assertInstanceOf('Traversable', $this->advisor);
    }
    
    /**
     * Ensures that iterating over the composite does not return any value
     * if no advisor was added.
     */
    public function testIterationReturnsNothingIfNoAdvisorWasAdded()
    {
        $this->assertInstanceOf('Traversable', $this->advisor);
        $numberOfItems = 0;
        foreach ($this->advisor as $advisor) {
            $numberOfItems++;
        }
        $this->assertEquals(0, $numberOfItems);
    }
    
    /**
     * Ensures that iterating over the composite returns only advisors.
     */
    public function testIterationReturnsOnlyAdvisors()
    {
        $this->assertInstanceOf('Traversable', $this->advisor);
        $this->assertContainsOnly('AspectPHP_Advisor', $this->advisor);
    }
    
    /**
     * Ensures that iterating over the composite returns the advisors that
     * were added before.
     */
    public function testIterationReturnsAddedAdvisors()
    {
        $first  = $this->createAdvisor(new AspectPHP_Pointcut_All());
        $second = $this->createAdvisor(new AspectPHP_Pointcut_None());
        $this->advisor->add($first);
        $this->advisor->add($second);
        $this->assertInstanceOf('Traversable', $this->advisor);
        foreach ($this->advisor as $advisor) {
            $this->assertContains($advisor, array($first, $second));
        }
    }
    
    /**
     * Creates a mocked advisor for testing.
     *
     * @param AspectPHP_Pointcut $pointcut
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createAdvisor(AspectPHP_Pointcut $pointcut)
    {
        $mock = $this->getMock('AspectPHP_Advisor');
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