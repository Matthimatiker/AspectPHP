<?php

/**
 * DemoAspect
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Example
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.01.2012
 */

/**
 * An aspect for demonstration purposes.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Example
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.01.2012
 */
class DemoAspect implements AspectPHP_Aspect
{
    
    /**
     * See {@link AspectPHP_Aspect::before()} for details.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function before(AspectPHP_JoinPoint $joinPoint)
    {
        echo 'before ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * See {@link AspectPHP_Aspect::afterReturning()} for details.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterReturning(AspectPHP_JoinPoint $joinPoint)
    {
        echo 'after ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * See {@link AspectPHP_Aspect::afterThrowing()} for details.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterThrowing(AspectPHP_JoinPoint $joinPoint)
    {
        
    }
    
}