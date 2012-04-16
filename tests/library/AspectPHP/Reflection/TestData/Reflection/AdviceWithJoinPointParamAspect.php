<?php

/**
 * Reflection_AdviceWithJoinPointParamAspect
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
 * Contains an advices that requires a join point as parameter.
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
class Reflection_AdviceWithJoinPointParamAspect implements AspectPHP_Aspect
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
     * An advice that requires a join point parameter.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     * @after pointcut()
     */
    public function afterAdvice(AspectPHP_JoinPoint $joinPoint)
    {
    }
    
}