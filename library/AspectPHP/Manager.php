<?php

/**
 * AspectPHP_Manager
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 11.01.2012
 */

/**
 * Interface for classes that are responsible for registering and
 * unregistering aspects.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 11.01.2012
 */
interface AspectPHP_Manager
{
    
    /**
     * Registers the given aspect.
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function register(AspectPHP_Aspect $aspect);
    
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
     * Returns a container with all advices that are registered for the
     * given method.
     *
     * @param string $method
     * @return AspectPHP_Advice_Container
     */
    public function getAdvicesFor($method);
    
}