<?php

/**
 * AspectPHP_ExampleTest
 *
 * @category PHP
 * @package AspectPHP_Example
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.04.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the example script.
 *
 * @category PHP
 * @package AspectPHP_Example
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 05.04.2012
 */
class AspectPHP_ExampleTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Ensures that the example script outputs the line that is echoed
     * by the Demo class.
     */
    public function testExampleOutputsLineFromDemoClass()
    {
        $output = $this->callExampleScript();
        $this->assertContains('Hello Matthias!', $output);
    }
    
    /**
     * Checks if the example script outputs the line that is echoed
     * by the before advice.
     */
    public function testExampleOutputsLineFromBeforeAdvice()
    {
        $output = $this->callExampleScript();
        $this->assertContains('before sayHello', $output);
    }
    
    /**
     * Checks if the example script outputs the line that is echoed
     * by the after advice.
     */
    public function testExampleOutputsLineFromAfterAdvice()
    {
        $output = $this->callExampleScript();
        $this->assertContains('after sayHello', $output);
    }
    
    /**
     * Calls the example script and returns its output.
     *
     * @return string
     */
    protected function callExampleScript()
    {
        $outputLines = array();
        $return      = null;
        $path        = dirname(__FILE__) . '/../../example/Example.php';
        $path        = realpath($path);
        
        exec('php ' . escapeshellarg($path), $outputLines, $return);
        
        $output  = implode(PHP_EOL, $outputLines);
        $message = 'Script did not terminate successfully: ' . PHP_EOL . $output;
        $this->assertEquals(0, $return, $message);
        return $output;
    }
    
}