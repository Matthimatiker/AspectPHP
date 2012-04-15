<?php

/**
 * Reflection_InvalidPointcutReturnValueAspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */

/**
 * Contains a pointcut method that does not return a pointcut value.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class Reflection_InvalidPointcutReturnValueAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns an invalid pointcut object.
     *
     * @return stdClass
     */
    public function pointcutInvalid()
    {
        return new stdClass();
    }
    
    /**
     * A dummy advice.
     *
     * @before pointcutInvalid()
     */
    public function beforeAdvice()
    {
    }
    
}