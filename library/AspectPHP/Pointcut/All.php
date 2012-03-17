<?php

/**
 * AspectPHP_Pointcut_All
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 14.03.2012
 */

/**
 * A pointcut that matches all methods.
 *
 * May be used for testing or as null object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 14.03.2012
 */
class AspectPHP_Pointcut_All implements AspectPHP_Pointcut
{
    
    /**
     * @see AspectPHP_Pointcut::matches()
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        return true;
    }
    
}