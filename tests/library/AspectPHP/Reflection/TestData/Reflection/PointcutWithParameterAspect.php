<?php

/**
 * Reflection_PointcutWithParameterAspect
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
 * Aspect that contains a pointcut that requires a parameter.
 *
 * Pointcuts with parameters are not supported.
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
class Reflection_PointcutWithParameterAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a dummy pointcut.
     *
     * @param mixed $notSupported
     * @return AspectPHP_Pointcut
     */
    public function pointcut($notSupported)
    {
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * A before dummy advice.
     *
     * @before pointcut()
     */
    public function beforeAdvice()
    {
    }
    
}