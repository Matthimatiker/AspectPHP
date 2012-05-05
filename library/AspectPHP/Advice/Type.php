<?php

/**
 * AspectPHP_Advice_Type
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
class AspectPHP_Advice_Type
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
     * Contains the cached names of all types.
     *
     * @var array(string)|null
     */
    protected static $types = null;
    
    /**
     * Returns all available types.
     *
     * @return array(string)
     */
    public static function all()
    {
        if (self::$types === null) {
            self::$types = self::determineTypes();
        }
        return self::$types;
        
    }
    
    /**
     * Creates a list of all existing advice types.
     *
     * @return array(string)
     */
    protected static function determineTypes()
    {
        $reflection = new ReflectionClass(__CLASS__);
        return array_values($reflection->getConstants());
    }
    
    /**
     * Checks if $type is a valid advice type.
     *
     * @param string $type
     * @return boolean True if a valid type name is provided, false otherwise.
     */
    public static function isValid($type)
    {
        return in_array($type, self::all(), true);
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
        if (!self::isValid($type)) {
            $template = '%s is not a valid name of an advice type. Valid type names are: %s';
            $message  = sprintf($template, self::toString($type), implode(', ', self::all()));
            throw new InvalidArgumentException($message);
        }
    }
    
    /**
     * Creates a string value that represents the provided value.
     *
     * Returns the value itself if it is already a string or the
     * type if no string is provided.
     *
     * @param mixed $value
     * @return string
     */
    protected static function toString($value)
    {
        if (is_string($value)) {
            return $value;
        }
        return '<' . gettype($value) . '>';
    }
    
}