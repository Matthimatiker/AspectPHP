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
        $this->setExpectedException('RuntimeException');
        $this->extractor->getAdvicesFrom(new Extractor_PointcutInvalidAspect());
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all before advices.
     */
    public function testGetAdvicesFromExtractsBeforeAdvices()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $this->assertEquals(2, count($advices->before()));
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all afterReturning advices.
     */
    public function testGetAdvicesFromExtractsAfterReturningAdvices()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $this->assertEquals(2, count($advices->afterReturning()));
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all afterThrowing advices.
     */
    public function testGetAdvicesFromExtractsAfterThrowingAdvices()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $this->assertEquals(2, count($advices->afterThrowing()));
    }
    
    /**
     * Checks if getAdvicesFrom() extracts all after advices.
     */
    public function testGetAdvicesFromExtractsAfterAdvices()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $this->assertEquals(2, count($advices->after()));
    }
    
    /**
     * Ensures that getAdvicesFrom() returns the correct number of advices of an advice method
     * is connected to multiple pointcuts via annotations.
     */
    public function testGetAdvicesFromReturnsCorrectNumberOfAdvicesIfOneMethodHasMultiplePointcutAnnotations()
    {
        $aspect  = new Extractor_MultipleReferencedPointcutAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $this->assertEquals(1, count($advices->before()), 'Unexpected number of before advices.');
        $this->assertEquals(1, count($advices->after()), 'Unexpected number of after advices.');
    }
    
    /**
     * Ensures that calling the before advices invokes the expected aspect methods.
     */
    public function testCallingBeforeAdvicesInvokesCorrectAspectMethods()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $advices->before()->invoke($this->createJoinPoint());
        $this->assertContains('adviceBeforeOne', $aspect->getCalledMethods());
        $this->assertContains('adviceBeforeTwo', $aspect->getCalledMethods());
    }
    
    /**
     * Ensures that calling the afterReturning advices invokes the expected aspect methods.
     */
    public function testCallingAfterReturningAdvicesInvokesCorrectAspectMethods()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $advices->afterReturning()->invoke($this->createJoinPoint());
        $this->assertContains('adviceAfterReturningOne', $aspect->getCalledMethods());
        $this->assertContains('adviceAfterReturningTwo', $aspect->getCalledMethods());
    }
    
    /**
     * Ensures that calling the afterThrowing advices invokes the expected aspect methods.
     */
    public function testCallingAfterThrowingAdvicesInvokesCorrectAspectMethods()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $advices->afterThrowing()->invoke($this->createJoinPoint());
        $this->assertContains('adviceAfterThrowingOne', $aspect->getCalledMethods());
        $this->assertContains('adviceAfterThrowingTwo', $aspect->getCalledMethods());
    }
    
    /**
     * Ensures that calling the after advices invokes the expected aspect methods.
     */
    public function testCallingAfterAdvicesInvokesCorrectAspectMethods()
    {
        $aspect  = new Extractor_MockAspect();
        $advices = $this->extractor->getAdvicesFrom($aspect);
        $this->assertInstanceOf('AspectPHP_Advice_Container', $advices);
        $advices->after()->invoke($this->createJoinPoint());
        $this->assertContains('adviceAfterOne', $aspect->getCalledMethods());
        $this->assertContains('adviceAfterTwo', $aspect->getCalledMethods());
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