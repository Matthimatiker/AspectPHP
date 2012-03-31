<?php

/**
 * Extractor_PointcutNotPublicAspect
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */

/**
 * Aspect with a pointcut method that is not public.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */
class Extractor_PointcutNotPublicAspect implements AspectPHP_Aspect
{
    
    /**
     * Pointcut method that is not public.
     *
     * @return AspectPHP_Pointcut
     */
    protected function protectedPointcut()
    {
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * An advice that references a pointcut that is not public.
     *
     * @before protectedPointcut()
     */
    public function beforeAdvice()
    {
    }
    
}