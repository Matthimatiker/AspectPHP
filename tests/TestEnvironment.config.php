<?php

/**
 * Initialization code for all unit tests.
 *
 * @category PHP
 * @package Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2011-2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 13.12.2011
 */

/**
 * Tests are always executed their own context.
 */
define('APPLICATION_ENV', 'unittests');

/** Load the default configuration. */
require_once(dirname(__FILE__) . '/../Environment.config.php');