<?php

/**
 * Demo
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Example
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.01.2012
 */

/**
 * Class for demonstration purposes.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Example
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.01.2012
 */
class Demo {
    
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