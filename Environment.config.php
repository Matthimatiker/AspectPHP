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

function autoload($class) {
    $file = str_replace(array('_', '\\'), '/', $class);
    $path = stream_resolve_include_path($file);
    if( $path === false) {
        return false;
    }
    require($path);
    return true;
}

?>
