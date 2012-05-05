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
    
    const BEFORE = 'before';
    
    const AFTER_THROWING = 'afterThrowing';
    
    const AFTER_RETURNING = 'afterReturning';
    
    const AFTER = 'after';
    
    public static function all()
    {
        
    }
    
    public static function isValid($type)
    {
        
    }
    
    public static function assertValid($type)
    {
        
    }
    
}