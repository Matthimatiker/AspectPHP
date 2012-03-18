<?php

/**
 * AspectPHP_Pointcut_All
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright 2012 Matthias Molitor
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
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
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