<?php

/**
 * Initialization code for all unit tests.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Tests
 * @copyright 2011-2012 Matthias Molitor
 * @version $Rev$
 * @since 13.12.2011
 */

/**
 * Tests are always executed their own context.
 */
define('APPLICATION_ENV', 'unittests');

/** Load the default configuration. */
require_once(dirname(__FILE__) . '/../Environment.config.php');