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
     * The modified content of the opened file.
     *
     * @var string
     */
    protected $content = '';
    
    /**
     * Current position in stream.
     *
     * @var integer
     */
    protected $position = 0;
    
    /**
     * The stats of the opened file.
     *
     * @var array(string|integer=>string|integer)
     */
    protected $stats = null;
    
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
     * @return boolean
     */
    public function stream_open($path, $mode, $options, &$openedPath)
    {
        $filePath = $this->removeScheme($path);
        if( !is_file($filePath) ) {
            return false;
        }
        $this->stats   = stat($filePath);
        $this->content = file_get_contents($filePath);
        return true;
    }

    /**
     * Reads data from the stream.
     *
     * @param integer $count The number of bytes.
     * @return string
     */
    public function stream_read($count)
    {
        $block = substr($this->content, $this->position, $count);
        $this->position += strlen($block);
        return $block;
    }


    /**
     * Returns the current position in the stream.
     *
     * @return integer
     */
    public function stream_tell()
    {
        return $this->position;
    }


    /**
     * Checks if the current position points to the end of the stream.
     *
     * @return boolean
     */
    public function stream_eof()
    {
        return $this->position >= $this->getContentLength();
    }


    /**
     * Returns meta data about the stream.
     *
     * @return array(mixed)
     */
    public function stream_stat()
    {
        return $this->stats;
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
        $filePath = $this->removeScheme($path);
        return stat($filePath);
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
        switch( $whence ) {
            case SEEK_SET:
                if ($offset >= 0 && $offset < $this->getContentLength()) {
                    $this->position = $offset;
                    return true;
                } else {
                    return false;
                }
                break;
            case SEEK_CUR:
                if ($offset >= 0) {
                    $this->position += $offset;
                    return true;
                } else {
                    return false;
                }
                break;
            case SEEK_END:
                if ($this->getContentLength() + $offset >= 0) {
                    $this->position = $this->getContentLength() + $offset;
                    return true;
                } else {
                    return false;
                }
                break;
            default:
                return false;
        }
    }
    
    /**
     * The length of the streamed content.
     *
     * @return integer
     */
    protected function getContentLength() {
        return strlen($this->content);
    }
    
    /**
     * Removes the stream scheme from the given path.
     *
     * @param string $path
     * @return string
     */
    protected function removeScheme($path) {
        return substr($path, strlen(self::NAME . '://'));
    }
    
}

?>