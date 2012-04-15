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
     * Creates a pointcut reflection object.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @param string $name
     * @throws AspectPHP_Reflection_Exception If the method is not a valid pointcut.
     */
    public function __construct($aspect, $name)
    {
        
    }
    
    /**
     * Returns information about the aspect that declares this pointcut.
     *
     * @return AspectPHP_Reflection_Aspect
     */
    public function getAspect()
    {
        
    }
    
    /**
     * Creates a pointcut object for the given aspect.
     *
     * The pointcut object is created only once per aspect object.
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Pointcut
     */
    public function createPointcut(AspectPHP_Aspect $aspect)
    {
        
    }
    
}