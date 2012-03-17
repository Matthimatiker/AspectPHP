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
    
    /**
     * The called method.
     *
     * @var ReflectionMethod
     */
    protected $method = null;
    
    /**
     * The provided method arguments.
     *
     * @var array(mixed)
     */
    protected $arguments = array();
    
    /**
     * The return value.
     *
     * @var mixed
     */
    protected $returnValue = null;
    
    /**
     * The exeception that was thrown.
     *
     * @var Exception|null
     */
    protected $exception = null;
    
    /**
     * The target method that will be called.
     *
     * @var mixed A callable.
     */
    protected $target = null;
    
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
    public function __construct($method, $context)
    {
        $this->method  = new ReflectionMethod($context, $method);
        $this->context = $context;
    }
    
    /**
     * Returns the arguments that were used to call the method.
     *
     * @return array(mixed)
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * Sets the arguments that are used to call the method.
     *
     * @param array(mixed) $arguments The arguments that are used to call the method.
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     */
    public function setArguments($arguments)
    {
        
        $this->arguments = $arguments + $this->getDefaultParameters();
        return $this;
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
     * @throws InvalidArgumentException If an invalid parameter name or index is provided.
     */
    public function getArgument($nameOrIndex)
    {
        $index = (is_string($nameOrIndex)) ? $this->getPositionFor($nameOrIndex) : $nameOrIndex;
        if( $index >= $this->method->getNumberOfParameters() ) {
            throw new InvalidArgumentException('Parameter #' . $index . ' was not declared.');
        }
        return $this->arguments[$index];
    }
    
    /**
     * Returns the name of the class whose method was called.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->method->class;
    }
    
    /**
     * The name of the called method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method->name;
    }
    
    /**
     * Returns the context of the called method.
     *
     * The context is the object whose method is called or
     * the name of the class if a static method is invoked.
     *
     * @return object|string
     */
    public function getContext()
    {
        return $this->context;
    }
    
    /**
     * Returns a callback to the method that will be or was invoked.
     *
     * @return array|string|Closure A callback.
     */
    public function getTarget()
    {
        if( $this->target === null ) {
            return array($this->getContext(), $this->getMethod());
        }
        return $this->target;
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
    public function setTarget($callback)
    {
        // Check only the syntax of the callback as it will
        // be called in another context.
        if( !is_callable($callback, true) ) {
            throw new InvalidArgumentException('Callback expected.');
        }
        $this->target = $callback;
        return $this;
    }
    
    /**
     * Returns the value that was returned by the called method.
     *
     * @return mixed|null
     */
    public function getReturnValue()
    {
        return $this->returnValue;
    }
    
    /**
     * Sets the return value.
     *
     * @param mixed $value
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     */
    public function setReturnValue($value)
    {
        $this->returnValue = $value;
        return $this;
    }
    
    /**
     * Returns the exception that was thrown by the method.
     *
     * Returns null if no exception was thrown.
     *
     * @return Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }
    
    /**
     * Sets the exception that was thrown by the method.
     *
     * If null is provided the previous exception is removed.
     *
     * @param Exception|null $exception
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     * @throws InvalidArgumentException If an invalid exception value is provided.
     */
    public function setException($exception)
    {
        if( $exception !== null && !($exception instanceof Exception) ) {
            throw new InvalidArgumentException('Expected instance of Exception or null.');
        }
        $this->exception = $exception;
        return $this;
    }
    
    /**
     * Returns the default parameter values for the method.
     *
     * The position of the parameter is used as key, the default
     * parameter as value.
     *
     * @return array(integer=>mixed)
     */
    protected function getDefaultParameters()
    {
        $defaults = array();
        foreach( $this->method->getParameters() as $parameter) {
            /* @var $parameter ReflectionParameter */
            if( $parameter->isOptional() ) {
                $defaults[$parameter->getPosition()] = $parameter->getDefaultValue();
            }
        }
        return $defaults;
    }
    
    /**
     * Returns the position of the parameter with the given name.
     *
     * @param string $parameterName
     * @return integer
     * @throws InvalidArgumentException If an invalid parameter name is provided.
     */
    protected function getPositionFor($parameterName)
    {
        foreach( $this->method->getParameters() as $parameter) {
            /* @var $parameter ReflectionParameter */
            if( $parameter->getName() === $parameterName ) {
                return $parameter->getPosition();
            }
        }
        throw new InvalidArgumentException('Parameter with name "' . $parameterName . '" does not exist.');
    }
    
}