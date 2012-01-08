<?php

/**
 * AspectPHP_JoinPoint
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 08.01.2012
 */

/**
 * Encapsulates information about a join point.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 08.01.2012
 */
class AspectPHP_JoinPoint {
    
    /**
     * Creates a join point event.
     *
     * <code>
     * $joinPoint = new AspectPHP_JoinPoint('MyClass::myMethod', array(1, 2, 3));
     * </code>
     *
     * @param string $method The method.
     * @param array(mixed) $arguments The arguments that were used to call the method.
     */
    public function __construct($method, $arguments) {
        
    }
    
    public function getArguments() {
        
    }
    
    public function getArgument($nameOrIndex) {
        
    }
    
    public function getClass() {
        
    }
    
    public function getContext() {
        
    }
    
    public function setContext($context) {
        
    }
    
    public function getReturnValue() {
        
    }
    
    public function setReturnValue($value) {
        
    }
    
    public function getException() {
        
    }
    
    public function setException(Exception $e) {
        
    }
    
}

?>