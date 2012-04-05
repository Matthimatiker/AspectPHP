<?php

/**
 * DemoAspect
 *
 * @category PHP
 * @package AspectPHP_Example
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.01.2012
 */

/**
 * An aspect for demonstration purposes.
 *
 * @category PHP
 * @package AspectPHP_Example
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.01.2012
 */
class DemoAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a pointcut that matches all method in the Demo class.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutDemoMethods()
    {
        return new AspectPHP_Pointcut_RegExp('Demo::.*');
    }
    
    /**
     * Outputs the method name before its execution.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     * @before pointcutDemoMethods()
     */
    public function beforeExecution(AspectPHP_JoinPoint $joinPoint)
    {
        echo 'before ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * Outputs the method name after its execution.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     * @after pointcutDemoMethods()
     */
    public function afterExecution(AspectPHP_JoinPoint $joinPoint)
    {
        echo 'after ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
}