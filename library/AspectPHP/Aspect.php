<?php

/**
 * AspectPHP_Aspect
 *
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 11.01.2012
 */

/**
 * Interface that must be implemented by aspects.
 *
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 11.01.2012
 */
interface AspectPHP_Aspect
{
    
    /**
     * Is called when the method was entered.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function before(AspectPHP_JoinPoint $joinPoint);
    
    /**
     * Is called when the original method returned a value.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterReturning(AspectPHP_JoinPoint $joinPoint);
    
    /**
     * Is called when an exception was thrown by the original method.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterThrowing(AspectPHP_JoinPoint $joinPoint);
    
}