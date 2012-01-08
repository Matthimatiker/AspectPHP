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
    
    /**
     * Returns the arguments that were used to call the method.
     *
     * @return array(mixed)
     */
    public function getArguments() {
        
    }
    
    /**
     * Returns the argument with the given name or the given position index.
     *
     * Assume the following method signagture:
     * <code>
     * public function registerPerson($name, $age) {
     * }
     * </code>
     *
     * Then the following calls to getArgument() both return the value
     * of the parameter $name:
     * <code>
     * $name = $joinPoint->getArgument('name');
     * $name = $joinPoint->getArgument(0);
     * </code>
     *
     * @param string|integer $nameOrIndex
     * @return mixed
     * @throws InvalidArgumentException If an invalid parameter name is provided.
     */
    public function getArgument($nameOrIndex) {
        
    }
    
    /**
     * Returns the name of the class whose method was called.
     *
     * @return string
     */
    public function getClass() {
        
    }
    
    /**
     * The name of the called method.
     *
     * @return string
     */
    public function getMethod() {
        
    }
    
    /**
     * Returns the context of the called method.
     *
     * The context is the object whose method is called or
     * the name of the class if a static method is invoked.
     *
     * @return object|string
     */
    public function getContext() {
        
    }
    
    /**
     * Sets the method context.
     *
     * @param object|string $context
     */
    public function setContext($context) {
        
    }
    
    /**
     * Returns the value that was returned by the called method.
     *
     * @return mixed|null
     */
    public function getReturnValue() {
        
    }
    
    /**
     * Sets the return value.
     *
     * @param mixed $value
     */
    public function setReturnValue($value) {
        
    }
    
    /**
     * Returns the exception that was thrown by the method.
     *
     * Returns null if no exception was thrown.
     *
     * @return Exception|null
     */
    public function getException() {
        
    }
    
    /**
     * Sets the exception that was thrown by the method.
     *
     * @param Exception $e
     */
    public function setException(Exception $e) {
        
    }
    
}

?>