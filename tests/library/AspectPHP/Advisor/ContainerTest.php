<?php

/**
 * AspectPHP_Advisor_ContainerTest
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
 * Tests the advisor container implementation.
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
class AspectPHP_Advisor_ContainerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Advisor_Container
     */
    protected $container = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->container = new AspectPHP_Advisor_Container();
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
     * Checks if before() returns an AspectPHP_Advisor_Composite object.
     */
    public function testBeforeReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advisor_Composite', $this->container->before());
    }
    
    /**
     * Checks if afterReturning() returns an AspectPHP_Advisor_Composite object.
     */
    public function testAfterReturningReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advisor_Composite', $this->container->afterReturning());
    }
    
    /**
     * Checks if afterThrowing() returns an AspectPHP_Advisor_Composite object.
     */
    public function testAfterThrowingReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advisor_Composite', $this->container->afterThrowing());
    }
    
    /**
     * Checks if after() returns an AspectPHP_Advisor_Composite object.
     */
    public function testAfterReturnsComposite()
    {
        $this->assertInstanceOf('AspectPHP_Advisor_Composite', $this->container->after());
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
     * Ensures that count() returns 0 if no advisor was added.
     */
    public function testCountReturnsZeroIfNoAdvisorWasAdded()
    {
        $this->assertEquals(0, $this->container->count());
    }
    
    /**
     * Checks if count() returns the number of added advisors.
     */
    public function testCountReturnsNumberOfAllAddedAdvisors()
    {
        $this->container->before()->add($this->createAdvisor());
        $this->container->afterReturning()->add($this->createAdvisor());
        $this->container->afterThrowing()->add($this->createAdvisor());
        $this->container->after()->add($this->createAdvisor());
        $this->assertEquals(4, $this->container->count());
    }
    
    /**
     * Checks if merge() provides a fluent interface.
     */
    public function testMergeProvidesFluentInterface()
    {
        $anotherContainer = new AspectPHP_Advisor_Container();
        $this->assertSame($this->container, $this->container->merge($anotherContainer));
    }
    
    /**
     * Ensures that merge() adds all advisors from the given container.
     */
    public function testMergeAddsAllAdvisorsFromProvidedContainer()
    {
        $anotherContainer = new AspectPHP_Advisor_Container();
        $anotherContainer->before()->add($this->createAdvisor());
        $anotherContainer->afterReturning()->add($this->createAdvisor());
        $anotherContainer->afterThrowing()->add($this->createAdvisor());
        $anotherContainer->after()->add($this->createAdvisor());
        
        $this->container->before()->add($this->createAdvisor());
        $this->container->afterReturning()->add($this->createAdvisor());
        $this->container->afterThrowing()->add($this->createAdvisor());
        $this->container->after()->add($this->createAdvisor());
        
        $this->container->merge($anotherContainer);
        $this->assertEquals(8, $this->container->count());
    }
    
    /**
     * Creates a mocked advisor for testing.
     *
     * @return AspectPHP_Advisor
     */
    protected function createAdvisor()
    {
        $mock = $this->getMock('AspectPHP_Advisor');
        $mock->expects($this->any())
             ->method('getPointcut')
             ->will($this->returnValue(new AspectPHP_Pointcut_All()));
        return $mock;
    }
    
}