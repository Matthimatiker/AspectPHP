<?php

/**
 * Reflection_MultipleReferencedPointcutAspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 13.04.2012
 */

/**
 * Aspect with a pointcut that is referenced by multiple advices.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 13.04.2012
 */
class Reflection_MultiplePointcutReferencesAspect implements AspectPHP_Aspect
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
     * A dummy advice.
     *
     * @before pointcut()
     */
    public function firstAdvice()
    {
    }
    
    /**
     * A dummy advice.
     *
     * @after pointcut()
     */
    public function secondAdvice()
    {
    }
    
}