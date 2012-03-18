<?php

/**
 * AspectPHP_Pointcut_None
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @since 16.03.2012
 */

/**
 * Pointcut that does not match any method.
 *
 * May be used for testing or as null object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @since 16.03.2012
 */
class AspectPHP_Pointcut_None implements AspectPHP_Pointcut
{
    
    /**
     * See {@link AspectPHP_Pointcut::matches()} for details.
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        return false;
    }
    
}