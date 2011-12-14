<?php

/**
 * AspectPHP_Stream_Wrapper
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Stream
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */

/**
 * Stream wrapper that adds injection points to loaded php classes.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Stream
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */
class AspectPHP_Stream_Wrapper {
    
    /**
     * Registers the stream wrapper.
     *
     * Does nothing if the wrapper is already registered.
     */
    public static function register() {
        
    }
    
    /**
     * Unregisters the stream wrapper.
     *
     * Does nothing if the wrapper is not registered.
     */
    public static function unregister() {
        
    }
    
    /**
     * Checks if the stream wrapper is registered.
     *
     * @return boolean True if the wrapper is registered, false otherwise.
     */
    public static function isRegistered() {
        
    }
    
}

?>