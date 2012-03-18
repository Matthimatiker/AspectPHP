<?php

/**
 * AspectPHP_Pointcut
 *
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @since 09.02.2012
 */

/**
 * Interface for classes that represent pointcut expressions.
 *
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @since 09.02.2012
 */
interface AspectPHP_Pointcut
{
    
    /**
     * Checks if the pointcut matches the given method.
     *
     * The method is provided as string that contains class name as
     * well as method name:
     * <code>
     * $pointcut->matches('MyClass::myMethod');
     * </code>
     *
     * @param string $method
     * @return boolean True if the pointcut matches the method, false otherwise.
     */
    public function matches($method);
    
}