<?php

/**
 * Configures the environment.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectP
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 16.10.2011
 */

// Do not suppress error messages.
error_reporting(E_ALL | E_STRICT);

set_include_path(dirname(__FILE__) . '/library' . PATH_SEPARATOR . get_include_path());

/**
 * Tries to load the class or interface $class.
 *
 * Replaces undescores by slashes to create the file path.
 * Requires PHP 5.3 because stream_resolve_include_path is used.
 *
 * @param string $class
 * @return boolean False if the class was not loaded.
 */
function autoload($class) {
    $file = str_replace(array('_', '\\'), '/', $class);
    $path = stream_resolve_include_path($file);
    if( $path === false) {
        return false;
    }
    require($path);
    return true;
}

spl_autoload_register('autoload');

?>