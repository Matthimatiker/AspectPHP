<?php

/**
 * AspectPHP_Pointcut_None
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.03.2012
 */

/**
 * Pointcut that does not match any method.
 *
 * May be used for testing or as null object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.03.2012
 */
class AspectPHP_Pointcut_None implements AspectPHP_Pointcut
{
    
    /**
     * @see AspectPHP_Pointcut::matches()
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        return false;
    }
    
}