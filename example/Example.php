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

$manager = AspectPHP_Container::getManager();
$manager->register(new DemoAspect());

$demo = new Demo();
// Should output:
// before sayHello
// Hello Matthias!
// after sayHello
$demo->sayHello('Matthias');