<?php

/**
 * AspectPHP_Advice_ContainerTest
 *
 * @category PHP
 * @package AspectPHP_Advice
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
 * @package AspectPHP_Advice
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
    
}