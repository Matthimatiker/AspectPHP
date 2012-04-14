<?php

/**
 * Reflection_ReferenceWithoutBracesAspect
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
 * Contains an advice that references its pointcut without trailing braces.
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
class Reflection_ReferenceWithoutBracesAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcut()
    {
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * A dummy advice.
     *
     * References the pointcut without trailing braces ("pointcut"
     * instead of "pointcut()").
     *
     * @before pointcut
     */
    public function beforeAdvice()
    {
    }
    
}