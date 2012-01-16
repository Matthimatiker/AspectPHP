<?php

/**
 * AspectPHP_Stream
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Stream
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */

/**
 * Stream that adds injection points to loaded php classes.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Stream
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */
class AspectPHP_Stream {
    
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
     * @var array(string|integer=>integer)
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
        $this->stats   = $this->getStats($path);
        $this->content = $this->addInjectionPoints($filePath);
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
        return $this->getStats($path, $flags);
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
        // TODO: simplify
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
     * Loads the content from the given file and modifies the source
     * code to add injection points.
     *
     * @param string $filePath
     * @return string
     */
    protected function addInjectionPoints($filePath) {
        $source         = file_get_contents($filePath);
        $transformation = new AspectPHP_Transformation_JoinPoints();
        $source         = $transformation->transform($source);
        
        // Replace __FILE__ constants with the original file path.
        $fullPath   = realpath($filePath);
        $tokens     = token_get_all($source);
        $newSource  = '';
        foreach( $tokens as $token ) {
            /* @var $token string|array(integer|string) */
            if( is_string($token) ) {
                $token = array(-1, $token);
            }
            if( $token[0] === T_FILE ) {
                $token[1] = "'$fullPath'";
            }
            $newSource .= $token[1];
        }
        return $newSource;
    }
    
    /**
     * Returns the stats for the given file path.
     *
     * Example:
     * <code>
     * $stats = $this->getStats('aspectphp://path/to/my/file');
     * </code>
     *
     * @todo respect STREAM_URL_STAT_LINK flag if information about a link is required
     *
     * @param string $path The path including the stream scheme.
     * @param integer $flags
     * @return array(string|integer=>integer)|false
     */
    protected function getStats($path, $flags = 0) {
        $filePath = $this->removeScheme($path);
        if( !file_exists($filePath) ) {
            $stats = array(
            	'dev'     => 0,
            	'ino'     => 0,
				'mode'    => 0777,
            	'nlink'   => 0,
            	'uid'     => 0,
            	'gid'     => 0,
            	'rdev'    => 0,
            	'size'    => 0,
            	'atime'   => 0,
            	'mtime'   => 0,
            	'ctime'   => 0,
            	'blksize' => 0,
            	'blocks'  => 0
            );
            return $stats;
        }
        $suppressErrors = ($flags & STREAM_URL_STAT_QUIET) === STREAM_URL_STAT_QUIET;
        if ($suppressErrors) {
            $stats = @stat($filePath);
        } else {
            $stats = stat($filePath);
        }
        return $stats;
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