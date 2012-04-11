<?php

/**
 * Reflection_SimpleAspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 11.04.2012
 */

/**
 * A simple aspect with 2 advices and 2 pointcuts.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 11.04.2012
 */
class Reflection_SimpleAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a dummy pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutOne()
    {
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * Returns a dummy pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutTwo()
    {
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * An after dummy advice.
     *
     * @after pointcutMethodsOfUser()
     */
    public function afterAdvice()
    {
    }
    
    /**
     * A before dummy advice.
     *
     * @before pointcutLogMethods()
     */
    public function beforeAdvice()
    {
    }
    
}