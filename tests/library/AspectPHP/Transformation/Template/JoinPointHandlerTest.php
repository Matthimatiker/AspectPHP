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
    
    /**
     * Ensures that the handler calls the compiled method if no aspect manager is available.
     */
    public function testHandlerExecutesCompiledMethodIfManagerIsNotAvailable()
    {
        
    }
    
    /**
     * Checks if the handler uses the aspect manager to request advices.
     */
    public function testHandlerRequestsAdvicesFromManager()
    {
        
    }
    
    /**
     * Checks if the handler requests advices for the correct method.
     */
    public function testHandlerRequestsAdvicesForCorrectMethod()
    {
        
    }
    
    /**
     * Ensures that the handler executes the compiled method if the aspect manager
     * does not provide any advice.
     */
    public function testHandlerExecutesCompiledMethodIfNoAdvicesAreAvailable()
    {
        
    }
    
    /**
     * Checks if the handler executes before advices.
     */
    public function testHandlerExecutesBeforeAdvices()
    {
        
    }
    
    /**
     * Ensures that the handler does not execute the compiled method if a before advice
     * provides a return value.
     */
    public function testHandlerDoesNotExecuteCompiledMethodIfBeforeAdviceProvidesReturnValue()
    {
        
    }
    
    /**
     * Ensures that the handler returns the result that is provided by a before advice.
     */
    public function testHandlerReturnsReturnValueThatIsProvidedByBeforeAdvice()
    {
        
    }
    
    /**
     * Ensures that the handler executes the compiled method even if advices
     * are available.
     */
    public function testHandlerExecutesCompiledMethodIfAdvicesAreAvailable()
    {
        
    }
    
    /**
     * Checks if the handler passes the provided arguments to the compiled method.
     */
    public function testHandlerPassesProvidedArgumentsToCompiledMethod()
    {
        
    }
    
    /**
     * Ensures that the handler passes modified arguments to the compiled method
     * if a before advice changed them.
     */
    public function testHandlerPassesArgumentsThatWereModifiedByBeforeAdviceToCompiledMethod()
    {
        
    }
    
    /**
     * Checks if the handler returns the result from the compiled method.
     */
    public function testHandlerReturnsReturnValueFromCompiledMethod()
    {
        
    }
    
    /**
     * Checks if the handler executes afterReturning advices.
     */
    public function testHandlerExecutesAfterReturningAdvices()
    {
        
    }
    
    /**
     * Ensures that the handler returns the result that is provided by an afterReturning advice.
     */
    public function testHandlerReturnsReturnValueModifiedByAfterReturningAdvice()
    {
        
    }
    
    /**
     * Ensures that the afterThrowing advice is not called if no exception occurred.
     */
    public function testHandlerDoesNotExecuteAfterThrowingAdviceIfNoExceptionOccurred()
    {
        
    }
    
    /**
     * Ensures that the afterThrowing advice is called if an exception was thrown
     * by the compiled method.
     */
    public function testHandlerExecutesAfterThrowingAdviceIfExceptionOccurred()
    {
        
    }
    
    /**
     * Checks if the afterThrowing advice has access to the exception that
     * was thrown by the compiled method.
     */
    public function testAfterThrowingAdviceCanAccessOriginalException()
    {
        
    }
    
    /**
     * Ensures that the handler suppresses an exception if the afterThrowing advice
     * provides a return value.
     */
    public function testHandlerSuppressesExceptionIfAfterThrowingAdviceProvidesReturnValue()
    {
        
    }
    
    /**
     * Checks if the handler returns the result that is provided by an afterThrowing advice.
     */
    public function testHandlerReturnsReturnValueProvidedByAfterThrowingAdvice()
    {
        
    }
    
    /**
     * Ensures that the original exception is thrown if the afterThrowing advice provides
     * neither result nor exception.
     */
    public function testHandlerThrowsOriginalExceptionIfAfterThrowingAdviceDoesNotInterfere()
    {
        
    }
    
    /**
     * Checks if the handler throws the exception that was provided by the afterThrowing
     * advice via the setException() method of the JoinPoint.
     */
    public function testHandlerThrowsExceptionThatWasSetByAfterThrowingAdvice()
    {
        
    }
    
    /**
     * Ensures that the afterThrowing advice is executed even if the exception was thrown
     * by a before advice.
     */
    public function testHandlerExecutesAfterThrowingAdviceIfBeforeAdviceThrowsException()
    {
    
    }
    
    /**
     * Checks if the handler executes after advices.
     */
    public function testHandlerExecutesAfterAdvices()
    {
        
    }
    
    /**
     * Ensures that the after advice is executed even if an exception was thrown.
     */
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