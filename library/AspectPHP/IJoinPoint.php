<?php

/**
 * AspectPHP_IJoinPoint
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 08.06.2012
 */

/**
 * Interface for classes that provide information about a join point.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 08.06.2012
 */
interface AspectPHP_IJoinPoint
{
    
    /**
     * Returns the object whose method is executed.
     *
     * Returns null if a static method was called.
     *
     * @return object|null
     */
    public function getThis();
    
    /**
     * Returns the type of this join point.
     *
     * @return string One of the AspectPHP_Advice_Type::* constants.
     */
    public function getType();
    
    /**
     * Returns the arguments that were used to call the method.
     *
     * @return array(mixed)
     */
    public function getArguments();
    
}