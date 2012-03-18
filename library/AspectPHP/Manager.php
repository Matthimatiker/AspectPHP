<?php

/**
 * AspectPHP_Manager
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 11.01.2012
 */

/**
 * Interface for classes that are responsible for registering and
 * unregistering aspects.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 11.01.2012
 */
interface AspectPHP_Manager
{
    
    /**
     * Registers the given aspect for all method calls that match the
     * given pointcut expression.
     *
     * @param AspectPHP_Aspect $aspect
     * @param string $pointcut
     */
    public function register(AspectPHP_Aspect $aspect, $pointcut);
    
    /**
     * Unregisters the given aspect.
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function unregister(AspectPHP_Aspect $aspect);
    
    /**
     * Returns all registered aspects.
     *
     * @return array(AspectPHP_Aspect)
     */
    public function getAspects();
    
    /**
     * Returns all aspects that are registered for handling the given method.
     *
     * @param string $method
     * @return array(AspectPHP_Aspect)
     */
    public function getAspectsFor($method);
    
}