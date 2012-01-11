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
     * The method context.
     *
     * Maybe an object instance or a class name for static methods.
     *
     * @var object|string
     */
    protected $context = null;
    
    protected $method = null;
    
    /**
     * Creates a join point event.
     *
     * <code>
     * $object    = new MyClass();
     * $joinPoint = new AspectPHP_JoinPoint('myMethod', $object);
     * </code>
     *
     * @param string $method The method.
     * @param object|string $context The method context (object or class name).
     */
    public function __construct($method, $context) {
        $this->method  = new ReflectionMethod($context, $method);
        $this->context = $context;
    }
    
    /**
     * Returns the arguments that were used to call the method.
     *
     * @return array(mixed)
     */
    public function getArguments() {
        
    }
    
	/**
     * Sets the arguments that are used to call the method.
     *
     * @param array(mixed) $arguments The arguments that are used to call the method.
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     */
    public function setArguments($arguments) {
        
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
        return $this->context;
    }
    
    /**
     * Returns a callback to the method that will be or was invoked.
     *
     * @return array|string|Closure
     */
    public function getTarget() {
        
    }
    
    /**
     * Sets the method that will be invoked.
     *
     * The provided argument must be a valid callback.
     *
     * @param array|string|Closure $callback
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     * @throws InvalidArgumentException If an invalid callback is provided.
     */
    public function setTarget($callback) {
        
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
     * @return AspectPHP_JoinPoint Provides a fluent interface.
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
     * If null is provided the previous exception is removed.
     *
     * @param Exception|null $e
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     */
    public function setException($e) {
        
    }
    
}

?>