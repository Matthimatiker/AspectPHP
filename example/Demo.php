<?php

/**
 * Demo
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
 * Class for demonstration purposes.
 *
 * @category PHP
 * @package AspectPHP_Example
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.01.2012
 */
class Demo
{
    
    /**
     * Outputs the provided name.
     *
     * @param string $name
     * @return string The name.
     */
    public function sayHello($name)
    {
        echo 'Hello ' . $name . '!' . PHP_EOL;
        return $name;
    }
    
}