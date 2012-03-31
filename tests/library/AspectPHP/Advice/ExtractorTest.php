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
    
    public function testGetAdvicesFromThrowsExceptionIfAdviceMethodIsNotPublic()
    {
        
    }
    
    public function testGetAdvicesFromThrowsExceptionIfReferencedPointcutMethodIsNotPublic()
    {
        
    }
    
    public function testGetAdvicesFromThrowsExceptionIfReferencedPointcutMethodDoesNotExist()
    {
    
    }
    
    public function testGetAdvicesFromExtractsBeforeAdvices()
    {
        
    }
    
    public function testGetAdvicesFromExtractsAfterReturningAdvices()
    {
    
    }
    
    public function testGetAdvicesFromExtractsAfterThrowingAdvices()
    {
    
    }
    
    public function testGetAdvicesFromExtractsAfterAdvices()
    {
    
    }
    
    public function testGetAdvicesFromReturnsCorrectNumberOfAdvicesIfOneMethodHasMultiplePointcutAnnotations()
    {
        
    }
    
    public function testCallingBeforeAdvicesInvokesCorrectAspectMethods()
    {
        
    }
    
    public function testCallingAfterReturningAdvicesInvokesCorrectAspectMethods()
    {
    
    }
    
    public function testCallingAfterThrowingAdvicesInvokesCorrectAspectMethods()
    {
    
    }
    
    public function testCallingAfterAdvicesInvokesCorrectAspectMethods()
    {
    
    }
    
}