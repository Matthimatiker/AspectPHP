<?php

/**
 * AspectPHP_Advice
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 02.06.2012
 */

/**
 * Interface for advices.
 *
 * An advice is a piece of code that can be executed if a join point occurs.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 02.06.2012
 */
interface AspectPHP_Advice
{
    
    /**
     * Executes the advice code.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function invoke(AspectPHP_JoinPoint $joinPoint);
    
}