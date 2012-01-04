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
     * The name that is used to access the stream (name://...).
     *
     * @var string
     */
    const NAME = 'aspectphp';
    
    /**
     * Registers the stream wrapper.
     *
     * Does nothing if the wrapper is already registered.
     */
    public static function register() {
        if( self::isRegistered() ) {
            return;
        }
        stream_wrapper_register(self::NAME, __CLASS__);
    }
    
    /**
     * Unregisters the stream wrapper.
     *
     * Does nothing if the wrapper is not registered.
     */
    public static function unregister() {
        if( !self::isRegistered() ) {
            return;
        }
        stream_wrapper_unregister(self::NAME);
    }
    
    /**
     * Checks if the stream wrapper is registered.
     *
     * @return boolean True if the wrapper is registered, false otherwise.
     */
    public static function isRegistered() {
        $wrappers = stream_get_wrappers();
        return in_array(self::NAME, $wrappers);
    }
    
	/**
     * Opens the code file and adds extension points.
     *
     * @param string $path
     * @param string $mode
     * @param integer $options
     * @param string $openedPath
     * @retgurn boolean
     */
    public function stream_open($path, $mode, $options, &$openedPath)
    {
        
    }

    /**
     * Reads data from the stream.
     *
     * @param integer $count The number of bytes.
     * @return string
     */
    public function stream_read($count)
    {
        
    }


    /**
     * Returns the current position in the stream.
     *
     * @return integer
     */
    public function stream_tell()
    {
        
    }


    /**
     * Checks if the current position points to the end of the stream.
     *
     * @return boolean
     */
    public function stream_eof()
    {
        
    }


    /**
     * Returns meta data about the stream.
     *
     * @return array(mixed)
     */
    public function stream_stat()
    {
        
    }

	/**
     * Returns meta data about the file.
     *
     * @param string $path The file path.
     * @param integer $flags
     * @return array(mixed)
     */
    public function url_stat($path , $flags)
    {
        
    }

    /**
     * Sets the current position to a specific point in the stream.
     *
     * @param integer $offset Offset in bytes.
     * @param integer $whence One of the SEEK_* contants.
     * @return boolean True if changing the position was successful, false otherwise.
     */
    public function stream_seek($offset, $whence = SEEK_SET)
    {
        
    }
    
}

?>