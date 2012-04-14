<?php

/**
 * Reflection_AdviceWithTooManyParamsAspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 14.04.2012
 */

/**
 * Contains an advices that requires too many (more than one) parameter.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 14.04.2012
 */
class Reflection_AdviceWithTooManyParamsAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a dummy pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcut()
    {
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * An advice that requires too many parameters.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     * @param mixed $context
     * @after pointcut()
     */
    public function afterAdvice($joinPoint, $context)
    {
    }
    
}