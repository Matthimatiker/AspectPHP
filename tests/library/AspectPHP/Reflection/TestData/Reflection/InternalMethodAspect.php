<?php

/**
 * Reflection_InternalMethodAspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.04.2012
 */

/**
 * An aspect that contains an internal AspectPHP method that is marked as advice.
 *
 * This situation may occur if an aspect is accidentially compiled by AspectPHP.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.04.2012
 */
class Reflection_InternalMethodAspect implements AspectPHP_Aspect
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
     * A simple advice.
     *
     * @before pointcut()
     */
    public function beforeAdvice()
    {
    }
    
    /**
     * A simple advice.
     *
     * @before pointcut()
     */
    private function _aspectPHPbeforeAdvice()
    {
    }
    
}