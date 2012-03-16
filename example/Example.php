<?php

/**
 * Example script.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Example
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.01.2012
 */

/**
 * Initialize environment.
 */
require_once(dirname(__FILE__) . '/../Environment.config.php');

// Add example directory to include path.
set_include_path(dirname(__FILE__) . PATH_SEPARATOR . get_include_path());

// Initialize the AspectPHP environment.
$environment = new AspectPHP_Environment();
$environment->initialize();

$manager = $environment->getManager();
$manager->register(new DemoAspect(), 'Demo::sayHello');

$demo = new Demo();
// Should output:
// before sayHello
// Hello Matthias!
// after sayHello
$demo->sayHello('Matthias');