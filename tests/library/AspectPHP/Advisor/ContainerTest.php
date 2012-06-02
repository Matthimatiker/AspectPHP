<?php

/**
 * AspectPHP_Advice_ContainerTest
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the advice container implementation.
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.03.2012
 */
class AspectPHP_Advice_ContainerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Advice_Container
     */
    protected $container = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->container = new AspectPHP_Advice_Container();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->container = null;
        parent::tearDown();
    }
    
    /**
     * Checks if before() returns an AspectPHP_Advice_Composite object.
     */
    public function testBeforeReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advice_Composite', $this->container->before());
    }
    
    /**
     * Checks if afterReturning() returns an AspectPHP_Advice_Composite object.
     */
    public function testAfterReturningReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advice_Composite', $this->container->afterReturning());
    }
    
    /**
     * Checks if afterThrowing() returns an AspectPHP_Advice_Composite object.
     */
    public function testAfterThrowingReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advice_Composite', $this->container->afterThrowing());
    }
    
    /**
     * Checks if after() returns an AspectPHP_Advice_Composite object.
     */
    public function testAfterReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advice_Composite', $this->container->after());
    }
    
    /**
     * Ensures that each call to before() returns the same object.
     */
    public function testBeforeReturnsSameObjectForEachCall()
    {
        $this->assertSame($this->container->before(), $this->container->before());
    }
    
    /**
     * Ensures that each call to afterReturning() returns the same object.
     */
    public function testAfterReturningReturnsSameObjectForEachCall()
    {
        $this->assertSame($this->container->afterReturning(), $this->container->afterReturning());
    }
    
    /**
     * Ensures that each call to afterThrowing() returns the same object.
     */
    public function testAfterThrowingReturnsSameObjectForEachCall()
    {
        $this->assertSame($this->container->afterThrowing(), $this->container->afterThrowing());
    }
    
    /**
     * Ensures that each call to after() returns the same object.
     */
    public function testAfterReturnsSameObjectForEachCall()
    {
        $this->assertSame($this->container->after(), $this->container->after());
    }
    
    /**
     * Ensures that the container returns a different composite object for
     * each advice type.
     */
    public function testContainerReturnsDifferentCompositeForEachType()
    {
        $objects = array(
            $this->container->before(),
            $this->container->afterReturning(),
            $this->container->afterThrowing(),
            $this->container->after()
        );
        
        $hashes = array_map('spl_object_hash', $objects);
        $this->assertEquals($hashes, array_unique($hashes), 'Same object returned for different advice types.');
    }
    
    /**
     * Checks if the container implements the Countable interface.
     */
    public function testContainerImplementsCountable()
    {
        $this->assertInstanceOf('Countable', $this->container);
    }
    
    /**
     * Ensures that count() returns 0 if no advice was added.
     */
    public function testCountReturnsZeroIfNoAdviceWasAdded()
    {
        $this->assertEquals(0, $this->container->count());
    }
    
    /**
     * Checks if count() returns the number of added advices.
     */
    public function testCountReturnsNumberOfAllAddedAdvices()
    {
        $this->container->before()->add($this->createAdvice());
        $this->container->afterReturning()->add($this->createAdvice());
        $this->container->afterThrowing()->add($this->createAdvice());
        $this->container->after()->add($this->createAdvice());
        $this->assertEquals(4, $this->container->count());
    }
    
    /**
     * Checks if merge() provides a fluent interface.
     */
    public function testMergeProvidesFluentInterface()
    {
        $anotherContainer = new AspectPHP_Advice_Container();
        $this->assertSame($this->container, $this->container->merge($anotherContainer));
    }
    
    /**
     * Ensures that merge() adds all advices from the given container.
     */
    public function testMergeAddsAllAdvicesFromProvidedContainer()
    {
        $anotherContainer = new AspectPHP_Advice_Container();
        $anotherContainer->before()->add($this->createAdvice());
        $anotherContainer->afterReturning()->add($this->createAdvice());
        $anotherContainer->afterThrowing()->add($this->createAdvice());
        $anotherContainer->after()->add($this->createAdvice());
        
        $this->container->before()->add($this->createAdvice());
        $this->container->afterReturning()->add($this->createAdvice());
        $this->container->afterThrowing()->add($this->createAdvice());
        $this->container->after()->add($this->createAdvice());
        
        $this->container->merge($anotherContainer);
        $this->assertEquals(8, $this->container->count());
    }
    
    /**
     * Creates a mocked advice for testing.
     *
     * @return AspectPHP_Advice
     */
    protected function createAdvice()
    {
        $mock = $this->getMock('AspectPHP_Advice');
        $mock->expects($this->any())
             ->method('getPointcut')
             ->will($this->returnValue(new AspectPHP_Pointcut_All()));
        return $mock;
    }
    
}