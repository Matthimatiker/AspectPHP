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
    protected function setUp() {
        parent::setUp();
        $this->transformation = new AspectPHP_Transformation_Replace();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        $this->transformation = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the provided source code is not modified if no rules were provided.
     */
    public function testTransformationDoesNothingIfNoRulesWereProvided() {
        
    }
    
    /**
     * Checks if the transformation replaces the specified tokens.
     */
    public function testTransformationReplacesSpecifiedTokens() {
        
    }
    
    /**
     * Ensures that the transformation replaces all occurences of the provided tokens.
     */
    public function testTransformationReplacesAllTokenOccurences() {
        
    }
    
    /**
     * Ensures that the transformation does not use rules that were overwritten.
     */
    public function testTransformationDoesNotUseRulesThatWereOverwritten() {
        
    }
    
    /**
     * Checks if the correct replacement values are used.
     */
    public function testTransformationUsesCorrectReplacementValues() {
        
    }
    
}

?>