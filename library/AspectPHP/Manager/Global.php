<?php

/**
 * AspectPHP_Manager_Global
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Manager
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 12.01.2012
 */

/**
 * Manager that store registered aspects globally.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Manager
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 12.01.2012
 */
class AspectPHP_Manager_Global implements AspectPHP_Manager {
    
    /**
     * @see AspectPHP_Manager::register()
     *
     * @param string $pointcut
     * @param AspectPHP_Aspect $aspect
     */
    public function register($pointcut, AspectPHP_Aspect $aspect) {
        
    }
    
    /**
     * @see AspectPHP_Manager::unregister()
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function unregister(AspectPHP_Aspect $aspect) {
        
    }
    
    /**
     * @see AspectPHP_Manager::getAspects()
     *
     * @return array(AspectPHP_Aspect)
     */
    public function getAspects() {
        
    }
    
    /**
     * @see AspectPHP_Manager::getMatchingAspects()
     *
     * @param string $method
     * @return array(AspectPHP_Aspect)
     */
    public function getMatchingAspects($method) {
        
    }
    
}

?>