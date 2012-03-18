<?php

/**
 * AspectPHP_Pointcut_All
 *
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 14.03.2012
 */

/**
 * A pointcut that matches all methods.
 *
 * May be used for testing or as null object.
 *
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 14.03.2012
 */
class AspectPHP_Pointcut_All implements AspectPHP_Pointcut
{
    
    /**
     * See {@link AspectPHP_Pointcut::matches()} for details.
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        return true;
    }
    
}