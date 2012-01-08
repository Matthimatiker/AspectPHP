<?php

/**
 * AspectPHP_JoinPointTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 08.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the JoinPoint implementation.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 08.01.2012
 */
class AspectPHP_JoinPointTest extends PHPUnit_Framework_TestCase {
    
    /**
     * This method and its parameters are used to create a join point for testing.
     *
     * @param string $name
     * @param boolean $register
     * @return AspectPHP_JoinPoint
     */
    protected function createJoinPoint($name, $register = true) {
        $arguments = func_get_args();
        return new AspectPHP_JoinPoint(__METHOD__, $arguments);
    }
    
}

?>