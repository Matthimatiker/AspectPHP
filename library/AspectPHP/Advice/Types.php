<?php

/**
 * AspectPHP_Advice_Types
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.05.2012
 */

/**
 * Contains constants for all available advice types and helper methods for type handling.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.05.2012
 */
class AspectPHP_Advice_Types
{
    
    /**
     * Type name for before advices.
     *
     * @var string
     */
    const BEFORE = 'before';
    
    /**
     * Type name for after throwing advices.
     *
     * @var string
     */
    const AFTER_THROWING = 'afterThrowing';
    
    /**
     * Type name for after returning advices.
     *
     * @var string
     */
    const AFTER_RETURNING = 'afterReturning';
    
    /**
     * Type name for after advices.
     *
     * @var string
     */
    const AFTER = 'after';
    
    /**
     * Returns all available types.
     *
     * @return array(string)
     */
    public static function all()
    {
        
    }
    
    /**
     * Checks if $type is a valid advice type.
     *
     * @param string $type
     * @return boolean True if a valid type name is provided, false otherwise.
     */
    public static function isValid($type)
    {
        
    }
    
    /**
     * Asserts tha $type is a valid advice type.
     *
     * Throws an exception if an invalid type is provided.
     *
     * @param string $type
     * @throws InvalidArgumentException If an invalid type is provided.
     */
    public static function assertValid($type)
    {
        
    }
    
}