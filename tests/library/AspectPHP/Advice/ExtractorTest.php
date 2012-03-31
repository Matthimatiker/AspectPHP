<?php

/**
 * AspectPHP_Advice_ExtractorTest
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

foreach (glob(dirname(__FILE__) . '/TestData/Extractor/*.php') as $helperFile) {
    /** Load file that contains a helper class for testing. */
    require_once($helperFile);
}

/**
 * Test the advice extractor.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */
class AspectPHP_Advice_ExtractorTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Advice_Extractor
     */
    protected $extractor = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->extractor = new AspectPHP_Advice_Extractor();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->extractor = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that getAdvicesFrom() throws an exception if an advice method
     * is not public.
     */
    public function testGetAdvicesFromThrowsExceptionIfAdviceMethodIsNotPublic()
    {
        $this->setExpectedException('RuntimeException');
        $this->extractor->getAdvicesFrom(new Extractor_AdviceNotPublicAspect());
    }
    
    /**
     * Ensures that getAdvicesFrom() throws an exception if a via annotation referenced
     * pointcut method is not public.
     */
    public function testGetAdvicesFromThrowsExceptionIfReferencedPointcutMethodIsNotPublic()
    {
        $this->setExpectedException('RuntimeException');
        $this->extractor->getAdvicesFrom(new Extractor_PointcutNotPublicAspect());
    }
    
    /**
     * Ensures that getAdvicesFrom() throws an exception if a via annotation referenced
     * pointcut method does not exist.
     */
    public function testGetAdvicesFromThrowsExceptionIfReferencedPointcutMethodDoesNotExist()
    {
        $this->setExpectedException('RuntimeException');
        $this->extractor->getAdvicesFrom(new Extractor_PointcutMissingAspect());
    }
    
    /**
     * Ensures that getAdvicesFrom() throws an exception if a via annotation referenced
     * pointcut method does not return a pointcut object.
     */
    public function testGetAdvicesFromThrowsExceptionIfReferencedPointcutMethodDoesNotReturnPointcutObject()
    {
        
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all before advices.
     */
    public function testGetAdvicesFromExtractsBeforeAdvices()
    {
        
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all afterReturning advices.
     */
    public function testGetAdvicesFromExtractsAfterReturningAdvices()
    {
    
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all afterThrowing advices.
     */
    public function testGetAdvicesFromExtractsAfterThrowingAdvices()
    {
    
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all after advices.
     */
    public function testGetAdvicesFromExtractsAfterAdvices()
    {
    
    }
    
    /**
     * Ensures that getAdvicesFrom() returns the correct number of advices of an advice method
     * is connected to multiple pointcuts via annotations.
     */
    public function testGetAdvicesFromReturnsCorrectNumberOfAdvicesIfOneMethodHasMultiplePointcutAnnotations()
    {
        
    }
    
    /**
     * Ensures that calling the before advices invokes the expected aspect methods.
     */
    public function testCallingBeforeAdvicesInvokesCorrectAspectMethods()
    {
        
    }
    
    /**
     * Ensures that calling the afterReturning advices invokes the expected aspect methods.
     */
    public function testCallingAfterReturningAdvicesInvokesCorrectAspectMethods()
    {
    
    }
    
    /**
     * Ensures that calling the afterThrowing advices invokes the expected aspect methods.
     */
    public function testCallingAfterThrowingAdvicesInvokesCorrectAspectMethods()
    {
    
    }
    
    /**
     * Ensures that calling the after advices invokes the expected aspect methods.
     */
    public function testCallingAfterAdvicesInvokesCorrectAspectMethods()
    {
    
    }
    
}