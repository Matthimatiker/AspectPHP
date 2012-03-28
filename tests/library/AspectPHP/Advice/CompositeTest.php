<?php

/**
 * AspectPHP_Advice_CompositeTest
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the composite advice.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */
class AspectPHP_Advice_CompositeTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Advice_Composite
     */
    protected $advice = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->advice = new AspectPHP_Advice_Composite();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->advice = null;
        parent::tearDown();
    }
    
    /**
     * Checks if the advice implements the AspectPHP_Advice interface.
     */
    public function testImplementsAdviceInterface()
    {
        $this->assertInstanceOf('AspectPHP_Advice', $this->advice);
    }
    
}