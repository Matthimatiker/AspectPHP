<?php

/**
 * AspectPHP_Transformation_JoinPointsTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the transformation class that adds injection points.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */
class AspectPHP_Transformation_JoinPointsTest extends PHPUnit_Framework_TestCase {
    
    /**
     * System under test.
     *
     * @var AspectPHP_Transformation_JoinPoints
     */
    protected $transformation = null;
    
    protected $original = null;
    
    protected $transformed = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $this->transformation = new AspectPHP_Transformation_JoinPoints();
        $this->original       = file_get_contents(dirname(__FILE__) . '/TestData/JoinPointsCheck/Transformation.php');
        $this->transformed    = $this->transformation->transform($this->original);
        if( !class_exists('JoinPointsCheck_Transformation', false) ) {
            eval($this->transformed);
        }
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->transformed    = null;
        $this->original       = null;
        $this->transformation = null;
        parent::tearDown();
    }
    
    public function testTransformReturnsString() {
        
    }
    
    // TODO: add tests
    // adds code
    // does not change context
    // does not suppress notices
    // does not suppress exceptions
    // does not change line numbers
    // does not change visibility of public method
    // does not change visibility of protected method
    // does not change visibility of private method
    // does not remove static attribute from method
    // does not remove final attribute from method
    // does not change doc blocks
    // does not change code that is not in a class
    // handles multiple classes in one code block
    
}

?>