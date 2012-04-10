<?php

/**
 * Example script.
 *
 * @category PHP
 * @package AspectPHP_Example
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
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
$manager->register(new DemoAspect());

$demo = new Demo();
// Should output:
// before sayHello
// Hello Matthias!
// after sayHello
$demo->sayHello('Matthias');