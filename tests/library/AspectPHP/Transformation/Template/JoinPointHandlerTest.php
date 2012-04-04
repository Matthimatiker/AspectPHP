<?php

/**
 * AspectPHP_Transformation_Template_JoinPointHandlerTest
 *
 * @category PHP
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 04.04.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the JoinPointHandler template.
 *
 * @category PHP
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 04.04.2012
 */
class AspectPHP_Transformation_Template_JoinPointHandlerTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * The manager that was stored before the test starts.
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
        $this->simulateManager(null);
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->restoreManager();
        parent::tearDown();
    }
    
    public function testHandlerExecutesCompiledMethodIfManagerIsNotAvailable()
    {
        
    }
    
    public function testHandlerRequestsAdvicesFromManager()
    {
        
    }
    
    public function testHandlerRequestsAdvicesForCorrectMethod()
    {
        
    }
    
    public function testHandlerExecutesCompiledMethodIfNoAdvicesAreAvailable()
    {
        
    }
    
    public function testHandlerExecutesBeforeAdvices()
    {
        
    }
    
    public function testHandlerDoesNotExecuteCompiledMethodIfBeforeAdviceProvidesReturnValue()
    {
        
    }
    
    public function testHandlerReturnsReturnValueThatIsProvidedByBeforeAdvice()
    {
        
    }
    
    public function testHandlerExecutesCompiledMethodIfAdvicesAreAvailable()
    {
        
    }
    
    public function testHandlerPassesProvidedArgumentsToCompiledMethod()
    {
        
    }
    
    public function testHandlerPassesArgumentsThatWereModifiedByBeforeAdviceToCompiledMethod()
    {
        
    }
    
    public function testHandlerReturnsReturnValueFromCompiledMethod()
    {
        
    }
    
    public function testHandlerExecutesAfterReturningAdvices()
    {
        
    }
    
    public function testHandlerReturnsReturnValueModifiedByAfterReturningAdvice()
    {
        
    }
    
    public function testHandlerDoesNotExecuteAfterThrowingAdviceIfNoExceptionOccurred()
    {
        
    }
    
    public function testHandlerExecutesAfterThrowingAdviceIfExceptionOccurred()
    {
        
    }
    
    public function testHandlerSuppressesExceptionIfAfterThrowingAdviceProvidesReturnValue()
    {
        
    }
    
    public function testHandlerReturnsReturnValueProvidedByAfterThrowingAdvice()
    {
        
    }
    
    public function testHandlerThrowsOriginalExceptionIfAfterThrowingAdviceDoesNotInterfere()
    {
        
    }
    
    public function testHandlerExecutesAfterThrowingAdviceIfBeforeAdviceThrowsException()
    {
    
    }
    
    public function testHandlerExecutesAfterAdvice()
    {
        
    }
    
    public function testHandlerExecutesAfterAdviceEvenIfExceptionOccurred()
    {
        
    }
    
    /**
     * Uses the given aspect manager for testing.
     *
     * @param AspectPHP_Manager|null $manager
     */
    protected function simulateManager($manager)
    {
        AspectPHP_Container::setManager($manager);
    }
    
    /**
     * Stores the current aspect manager.
     */
    protected function storeManager()
    {
        $this->previousManager = AspectPHP_Container::hasManager() ? AspectPHP_Container::getManager() : null;
    }
    
    /**
     * Restores the previously stored aspect manager.
     */
    protected function restoreManager()
    {
        AspectPHP_Container::setManager($this->previousManager);
    }
    
}