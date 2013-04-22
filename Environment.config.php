<?php

/**
 * Configures the environment.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.10.2011
 */

// Do not suppress error messages.
error_reporting(E_ALL | E_STRICT);

set_include_path(dirname(__FILE__) . '/library' . PATH_SEPARATOR . get_include_path());

require_once(dirname(__FILE__) . '/vendor/autoload.php');