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
class DemoAspect implements AspectPHP_Aspect {
    
    /**
     * @see AspectPHP_Aspect::before()
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function before(AspectPHP_JoinPoint $joinPoint) {
        echo 'before ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * @see AspectPHP_Aspect::afterReturning()
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterReturning(AspectPHP_JoinPoint $joinPoint) {
        echo 'after ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * @see AspectPHP_Aspect::afterThrowing()
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterThrowing(AspectPHP_JoinPoint $joinPoint) {
        
    }
    
}

?>