<?php

/**
 * Extractor_AdviceNotPublicAspect
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
 * Aspect with an advice method that is not public.
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
class Extractor_AdviceNotPublicAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcut()
    {
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * An advice that is not public.
     *
     * @before pointcut()
     */
    protected function protectedBeforeAdvice()
    {
    }
    
}