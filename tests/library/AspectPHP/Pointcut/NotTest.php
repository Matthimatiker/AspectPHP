<?php

/**
 * AspectPHP_Pointcut_NotTest
 *
 * @category PHP
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the Not pointcut.
 *
 * @category PHP
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.03.2012
 */
class AspectPHP_Pointcut_NotTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Checks if the class implements the AspectPHP_Pointcut interface.
     */
    public function testPointcutImplementsInterface()
    {
        $this->assertInstanceOf('AspectPHP_Pointcut', $this->createPointcut(new AspectPHP_Pointcut_All()));
    }
    
    /**
     * Ensures that matches() inverts the result if the inner pointcut returns true.
     */
    public function testMatchesNegatesTrue()
    {
        $pointcut = $this->createPointcut(new AspectPHP_Pointcut_All());
        $this->assertFalse($pointcut->matches(__METHOD__));
    }
    
    /**
     * Ensures that matches() inverts the result if the inner pointcut returns false.
     */
    public function testMatchesNegatesFalse()
    {
        $pointcut = $this->createPointcut(new AspectPHP_Pointcut_None());
        $this->assertTrue($pointcut->matches(__METHOD__));
    }
    
    /**
     * Returns a Not pointcut with the provided inner pointcut.
     *
     * @param AspectPHP_Pointcut $inner
     * @return AspectPHP_Pointcut_Not
     */
    protected function createPointcut(AspectPHP_Pointcut $inner)
    {
        return new AspectPHP_Pointcut_Not($inner);
    }
    
}