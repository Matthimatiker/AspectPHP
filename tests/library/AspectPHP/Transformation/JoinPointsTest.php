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
    
    /**
     * The original code.
     *
     * @var string
     */
    protected $original = null;
    
    /**
     * The transformed code.
     *
     * @var string
     */
    protected $transformed = null;
    
    /**
     * An instance of the transformed class.
     *
     * @var JoinPointsCheck_Transformation
     */
    protected $transformedInstance = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $this->transformation = new AspectPHP_Transformation_JoinPoints();
        $this->original       = file_get_contents(dirname(__FILE__) . '/TestData/JoinPointsCheck/Transformation.php');
        $this->transformed    = $this->transformation->transform($this->original);
        if( !class_exists('JoinPointsCheck_Transformation', false) ) {
            // We execute the transformed code to be able to use the reflection api for testing.
            // We assume that the same input is always transformed into the same output.
            // Otherwise our test might be incorrect, because the execution is done only
            // once per process.
            // Remove opening tag as eval does not accept it.
            $code = substr($this->transformed, strlen('<?php'));
            eval($code);
        }
        $message = 'Class "JoinPointsCheck_Transformation" is not available.';
        $this->assertTrue(class_exists('JoinPointsCheck_Transformation', false), $message);
        $this->transformedInstance = new JoinPointsCheck_Transformation();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->transformedInstance = null;
        $this->transformed         = null;
        $this->original            = null;
        $this->transformation      = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that transform() returns a string.
     */
    public function testTransformReturnsString() {
        $this->assertInternalType('string', $this->transformation->transform($this->original));
    }
    
    /**
     * Checks if the same input always leads to the same output.
     */
    public function testTransformIsDeterministic() {
        $first  = $this->transformation->transform($this->original);
        $second = $this->transformation->transform($this->original);
        $this->assertEquals($first, $second);
    }
    
    /**
     * Tests if code is added by the transformation.
     */
    public function testTransformationAddsCode() {
        $message = 'Code size did not increase as expected.';
        $this->assertGreaterThan(strlen($this->original), strlen($this->transformed), $message);
    }
    
    /**
     * Ensures that the transformation does not change the method context ($this).
     */
    public function testTransformationDoesNotChangeContext() {
        $this->assertSame($this->transformedInstance, $this->transformedInstance->getContext());
    }
    
    /**
     * Ensures that the transformed code does not suppress notices.
     */
    public function testTransformedCodeDoesNotSuppressNotices() {
        $this->setExpectedException('PHPUnit_Framework_Error_Notice');
        $this->transformedInstance->triggerNotice();
        
    }
    
    /**
     * Ensures that the transformed code does not suppress exceptions.
     */
    public function testTransformedCodeDoesNotSuppressExceptions() {
        $this->setExpectedException('RuntimeException');
        $this->transformedInstance->throwException();
    }
    // does not change line numbers
    // does not change visibility of public method
    // does not change visibility of protected method
    // does not change visibility of private method
    // does not remove static attribute from method
    // does not remove final attribute from method
    // does not change doc blocks
    // does not change code that is not in a class
    // handles multiple classes in one code block
    // advice invocation
    
}

?>