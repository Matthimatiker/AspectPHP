<?php

/**
 * AspectPHP_Advisor
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */

/**
 * Interface for advisors.
 *
 * An advisor consists of a pointcut and advice code that is executed if
 * the specified join point occurs.
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 27.03.2012
 */
interface AspectPHP_Advisor extends AspectPHP_Advice
{
    
    /**
     * Returns the pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function getPointcut();
    
}