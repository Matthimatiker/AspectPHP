<?php

/**
 * AspectPHP_Advice_Callback
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */

/**
 * Encapsulates a pointcut and a callback that is used to execute advice code.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */
class AspectPHP_Advice_Callback implements AspectPHP_Advice
{
    
    /**
     * See {@link AspectPHP_Advice::getPointcut()} for details.
     *
     * @return AspectPHP_Pointcut
     */
    public function getPointcut()
    {
        
    }
    
    /**
     * See {@link AspectPHP_Advice::invoke()} for details.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function invoke(AspectPHP_JoinPoint $joinPoint)
    {
        
    }
    
}