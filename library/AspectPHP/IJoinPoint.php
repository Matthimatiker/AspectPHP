<?php

/**
 * AspectPHP_IJoinPoint
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 08.06.2012
 */

/**
 * Interface for classes that provide information about a join point.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 08.06.2012
 */
interface AspectPHP_IJoinPoint
{
    
    /**
     * Returns the name of the class whose method was called.
     *
     * @return string
     */
    public function getClass();
    
    /**
     * The name of the called method.
     *
     * @return string
     */
    public function getMethod();
    
    /**
     * Returns the object whose method is executed.
     *
     * Returns null if a static method was called.
     *
     * @return object|null
     */
    public function getThis();
    
    /**
     * Returns the type of this join point.
     *
     * @return string One of the AspectPHP_Advice_Type::* constants.
     */
    public function getType();
    
    /**
     * Returns all arguments that were used to call the method.
     *
     * @return array(mixed)
     */
    public function getArguments();
    
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
    public function getArgument($nameOrIndex);
    
    /**
     * Sets the arguments that are used to call the method.
     *
     * @param array(mixed) $arguments The arguments that are used to call the method.
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     */
    public function setArguments($arguments);
    
    /**
     * Returns the value that was returned by the called method.
     *
     * @return mixed|null
     */
    public function getReturnValue();
    
    /**
     * Sets the return value.
     *
     * Setting a return value will remove exceptions that were
     * added via setException() before.
     *
     * @param mixed $value
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     */
    public function setReturnValue($value);
    
    /**
     * Checks if a return value was provided via setReturnValue().
     *
     * @return boolean True if a return value is available, false otherwise.
     */
    public function hasReturnValue();
    
    /**
     * Returns the exception that was thrown by the method.
     *
     * Returns null if no exception was thrown.
     *
     * @return Exception|null
     */
    public function getException();
    
    /**
     * Sets the exception that was thrown by the method.
     *
     * If null is provided the previous exception is removed.
     *
     * @param Exception|null $exception
     * @return AspectPHP_JoinPoint Provides a fluent interface.
     * @throws InvalidArgumentException If an invalid exception value is provided.
     */
    public function setException($exception);
    
    /**
     * Checks if an exception was provided via setException().
     *
     * @return boolean True if an exception is available, false otherwise.
     */
    public function hasException();
    
}