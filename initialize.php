<?php

/**
 * Initializes the AspectPHP environment.
 *
 * Hooks into the Composer class loader and modifies the include
 * path to ensure that hooks are weaved into loaded classes.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/*
 * @since 22.04.2013
 */

// This file is called in the class loader initializer of Composer.
// Therefore, we can access the classname of the initializer and
// retrieve the class loader.
$loaderInitializer = get_class();
/* @var $loader \Composer\Autoload\ClassLoader */
$loader = call_user_func(array($loaderInitializer, 'getLoader'));

// Hook into class loader and include path.
$environment = new AspectPHP_Environment();
$environment->exposeManager();
$environment->registerStream();
$environment->prepareClassLoader($loader);
//$environment->prepareIncludePath();
