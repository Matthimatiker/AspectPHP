<?php

/**
 * AspectPHP_Transformation_Template_JoinPointHandler
 *
 * @category PHP
 * @package AspectPHP_Transformation
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 04.04.2012
 */

/**
 * Contains code templates that will be weaved into classes.
 *
 * The templates are responsible for handling the JoinPoints
 * logic and act as a proxy for calls to the original methods.
 *
 * @category PHP
 * @package AspectPHP_Transformation
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 04.04.2012
 */
class AspectPHP_Transformation_Template_JoinPointHandler
{
    
    /**
     * Handles method calls.
     *
     * Contains logic regarding the aspect and join point handling.
     *
     * This method is injected into all compiled classes. Otherwise it
     * would not be possible to forward to its private methods.
     *
     * @param string $method The name of the called method.
     * @param string $compiledMethod The name of the method that will be called internally.
     * @param object|string $context The context of the method call.
     * @param array(mixed) $args The method arguments.
     * @return mixed
     * @throws Exception If the original method or a join point throws an exception.
     */
    private static function _aspectPHPInternalHandleCall($method, $compiledMethod, $context, $args)
    {
        if (!AspectPHP_Container::hasManager()) {
            // Aspect manager not available, just execute the original method.
            return call_user_func_array(array($context, $compiledMethod), $args);
        }
        $advices = AspectPHP_Container::getManager()->getAdvicesFor(__CLASS__ . '::' . $method);
        if (count($advices) === 0) {
            // No advices available for the compiled method. Therefore skip advice
            // handling and execute the original method.
            return call_user_func_array(array($context, $compiledMethod), $args);
        }
        
        $joinPoint = new AspectPHP_JoinPoint($method, $context);
        $joinPoint->setArguments($args);
        try {
            $advices->before()->invoke($joinPoint);
            
            $returnValue = call_user_func_array(array($context, $compiledMethod), $args);
            $joinPoint->setReturnValue($returnValue);
            
            $advices->afterReturning()->invoke($joinPoint);
            $advices->after()->invoke($joinPoint);
        } catch(Exception $e) {
            $joinPoint->setException($e);
            $advices->afterThrowing()->invoke($joinPoint);
            $advices->after()->invoke($joinPoint);
            if ($joinPoint->getException() !== null) {
                throw $joinPoint->getException();
            }
        }
        return $joinPoint->getReturnValue();
    }
    
    /**
     * Forwards method calls to the private method _aspectPHPInternalHandleCall().
     *
     * This method exists for testing purposes only.
     * See {@link _aspectPHPInternalHandleCall()} for details about the parameters.
     *
     * @param string $method
     * @param string $compiledMethod
     * @param object|string $context
     * @param array(mixed) $args
     * @return mixed
     */
    public static function forwardToHandleCall($method, $compiledMethod, $context, $args)
    {
        return self::_aspectPHPInternalHandleCall($method, $compiledMethod, $context, $args);
    }
    
}