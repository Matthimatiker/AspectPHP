<?php

/**
 * AspectPHP_Reflection_Aspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 09.04.2012
 */

/**
 * Reflection class that is used to gather information about an aspect.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 09.04.2012
 */
class AspectPHP_Reflection_Aspect
{
    
    /**
     * Returns all pointcut methods.
     *
     * A method is considered as pointcut if it starts with the
     * prefix "pointcut" or if it is referenced by an advice.
     *
     * @return array(ReflectionMethod)
     */
    public function getPointcuts()
    {
        
    }
    
    /**
     * Returns the pointcut method with the provided name.
     *
     * @param string $name
     * @return ReflectionMethod
     * @throws AspectPHP_Reflection_Exception If the requested method is not considered as pointcut.
     */
    public function getPointcut($name)
    {
        
    }
    
    /**
     * Returns all advice methods.
     *
     * A method is considered as advice method if it references
     * a pointcut via annotations.
     *
     * @return array(ReflectionMethod)
     */
    public function getAdvices()
    {
        
    }
    
    /**
     * Returns the advice method with the provided name.
     *
     * @param string $name
     * @return ReflectionMethod
     * @throws AspectPHP_Reflection_Exception If the requested method is not considered as advice.
     */
    public function getAdvice($name)
    {
    
    }
    
}