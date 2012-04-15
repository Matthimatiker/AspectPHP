<?php

/**
 * AspectPHP_Reflection_Pointcut
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */

/**
 * Represents a pointcut method.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_Pointcut extends ReflectionMethod
{
    
    /**
     *
     *
     * @param AspectPHP_Reflection_Aspect $aspect
     * @param string $name
     * @throws AspectPHP_Reflection_Exception If the method is not a valid pointcut.
     */
    public function __construct(AspectPHP_Reflection_Aspect $aspect, $name)
    {
        
    }
    
    /**
     * @return AspectPHP_Reflection_Aspect
     */
    public function getAspect()
    {
        
    }
    
    /**
     *
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Pointcut
     */
    public function createPointcut(AspectPHP_Aspect $aspect)
    {
        
    }
    
}