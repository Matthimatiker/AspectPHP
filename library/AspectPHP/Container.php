<?php

/**
 * AspectPHP_Container
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 15.01.2012
 */

/**
 * Class that holds the global aspect manager object.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 15.01.2012
 */
class AspectPHP_Container
{
    
    /**
     * The object that manages the aspects.
     *
     * @var AspectPHP_Manager
     */
    protected static $manager = null;
    
    /**
     * Sets the aspect manager.
     *
     * @param AspectPHP_Manager|null $manager
     * @throws InvalidArgumentException If an invalid argument is provided.
     */
    public static function setManager($manager)
    {
        if( $manager !== null && !($manager instanceof AspectPHP_Manager) ) {
            throw new InvalidArgumentException('Expected null or instance of AspectPHP_Manager.');
        }
        self::$manager = $manager;
    }
    
    /**
     * Returns the registered aspect manager.
     *
     * @return AspectPHP_Manager
     * @throws BadMethodCallException If no manager is available.
     */
    public static function getManager()
    {
        if( !self::hasManager() ) {
            $message = 'Aspect manager is not available. Use ' . __CLASS__ . '::setManager() to provide a manager.';
            throw new BadMethodCallException($message);
        }
        return self::$manager;
    }
    
    /**
     * Checks if an aspect manager is available.
     *
     * @return boolean True if a manager is available, false otherwise.
     */
    public static function hasManager()
    {
        return self::$manager !== null;
    }
    
}