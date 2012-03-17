<?php

/**
 * AspectPHP_Transformation_ReplaceTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 17.01.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the replace transformation.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 17.01.2012
 */
class AspectPHP_Transformation_ReplaceTest extends PHPUnit_Framework_TestCase {
    
    /**
     * System under test.
     *
     * @var AspectPHP_Transformation_Replace
     */
    protected $transformation = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->transformation = new AspectPHP_Transformation_Replace();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->transformation = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the provided source code is not modified if no rules were provided.
     */
    public function testTransformationDoesNothingIfNoRulesWereProvided()
    {
        $source = '<?php ?>';
        $this->assertEquals($source, $this->transformation->transform($source));
    }
    
    /**
     * Checks if the transformation replaces the specified tokens.
     */
    public function testTransformationReplacesSpecifiedTokens()
    {
        $rules = array(
            T_OPEN_TAG => ''
        );
        $this->transformation->setRules($rules);
        $transformed = $this->transformation->transform('<?php ?>');
        $this->assertInternalType('string', $transformed);
        $this->assertNotContains('<?php', $transformed);
    }
    
    /**
     * Ensures that the transformation replaces all occurences of the provided tokens.
     */
    public function testTransformationReplacesAllTokenOccurences()
    {
        $source = '<?php function hello() {} function bye() {} ?>';
        $rules  = array(
            T_FUNCTION => ''
        );
        $this->transformation->setRules($rules);
        $transformed = $this->transformation->transform($source);
        $this->assertInternalType('string', $transformed);
        $this->assertNotContains('function', $transformed);
    }
    
    /**
     * Ensures that the transformation does not use rules that were overwritten.
     */
    public function testTransformationDoesNotUseRulesThatWereOverwritten()
    {
        $rules = array(
            T_OPEN_TAG => ''
        );
        $this->transformation->setRules($rules);
        $rules = array(
            T_CLOSE_TAG => ''
        );
        $this->transformation->setRules($rules);
        // The T_OPEN_TAG rule was overwritten, therefore "<?php" should not be replaced.
        $transformed = $this->transformation->transform('<?php ?>');
        $this->assertInternalType('string', $transformed);
        $this->assertContains('<?php', $transformed);
    }
    
    /**
     * Checks if the correct replacement values are used.
     */
    public function testTransformationUsesCorrectReplacementValues()
    {
        $rules = array(
            T_OPEN_TAG  => 'open',
            T_CLOSE_TAG => 'close'
        );
        $this->transformation->setRules($rules);
        $this->assertEquals('open close', $this->transformation->transform('<?php  ?>'));
    }
    
}