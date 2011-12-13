<?php

/**
 * Initialization code for all unit tests.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */

/**
 * Tests are always executed their own context.
 */
define('APPLICATION_ENV', 'unittests');

/** Load the default configuration. */
require_once(dirname(__FILE__) . '/../Environment.config.php');

?>