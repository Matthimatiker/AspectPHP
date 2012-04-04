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
        if (AspectPHP_Container::hasManager()) {
            $aspects = AspectPHP_Container::getManager()->getAspectsFor(__CLASS__ . '::' . $method);
        } else {
            $aspects = array();
        }
        if (count($aspects) === 0) {
            return call_user_func_array(array($context, $compiledMethod), $args);
        }
        $joinPoint = new AspectPHP_JoinPoint($method, $context);
        $joinPoint->setArguments($args);
        foreach ($aspects as $aspect) {
            /* @var $aspect AspectPHP_Aspect */
            $aspect->before($joinPoint);
        }
        try {
            $returnValue = call_user_func_array(array($context, $compiledMethod), $args);
            $joinPoint->setReturnValue($returnValue);
            foreach ($aspects as $aspect) {
                /* @var $aspect AspectPHP_Aspect */
                $aspect->afterReturning($joinPoint);
            }
            return $joinPoint->getReturnValue();
        } catch(Exception $e) {
            $joinPoint->setException($e);
            foreach ($aspects as $aspect) {
                /* @var $aspect AspectPHP_Aspect */
                $aspect->afterThrowing($joinPoint);
            }
            throw $e;
        }
    }
    
}