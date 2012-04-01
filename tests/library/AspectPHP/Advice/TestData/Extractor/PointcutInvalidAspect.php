<?php

/**
 * Extractor_PointcutInvalidAspect
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.04.2012
 */

/**
 * Aspect with a pointcut method that returns an invalid object.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.04.2012
 */
class Extractor_PointcutInvalidAspect implements AspectPHP_Aspect
{
    
    /**
     * Does not return a valid pointcut object.
     *
     * @return stdClass
     */
    public function invalidPointcut()
    {
        return new stdClass();
    }
    
    /**
     * Advices that references a pointcut method with invalid
     * return type.
     *
     * @before invalidPointcut()
     */
    public function beforeAdvice()
    {
        
    }
    
}