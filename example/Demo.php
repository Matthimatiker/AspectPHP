<?php

/**
 * Demo
 *
 * @package AspectPHP
 * @subpackage Example
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 16.01.2012
 */

/**
 * Class for demonstration purposes.
 *
 * @package AspectPHP
 * @subpackage Example
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 16.01.2012
 */
class Demo
{
    
    /**
     * Outputs the given name.
     *
     * @param string $name
     */
    public function sayHello($name)
    {
        echo 'Hello ' . $name . '!' . PHP_EOL;
        return $name;
    }
    
}