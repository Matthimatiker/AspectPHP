<?php

/**
 * AspectPHP_Code_ExtractorTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @subpackage Test
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 11.02.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Load class wit test data.
 */
require_once(dirname(__FILE__) . '/TestData/Extractor/Method.php');

/**
 * Tests the code extractor.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @subpackage Test
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 11.02.2012
 */
class AspectPHP_Code_ExtractorTest extends PHPUnit_Framework_TestCase {
    
    /**
     * System under test.
     *
     * @var AspectPHP_Code_Extractor
     */
    protected $extractor = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->extractor = new AspectPHP_Code_Extractor();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->extractor = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that an exception is thrown if an invalid method identifier is provided.
     */
    public function testGetSourceThrowsExceptionIfInvalidMethodIdentifierIsProvided()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->extractor->getSource('invalid');
    }
    
    /**
     * Ensures that an exception is thrown if the class does not exist.
     */
    public function testGetSourceThrowsExceptionIfClassDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->extractor->getSource('missing::demo');
    }
    
    /**
     * Ensures that an exception is thrown if the method does not exist.
     */
    public function testGetSourceThrowsExceptionIfMethodDoesNotExist()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->extractor->getSource('Extractor_Method::missing');
    }
    
    /**
     * Checks if getSource() returns the method body.
     */
    public function testGetSourceReturnsMethodBody()
    {
        $source = $this->extractor->getSource('Extractor_Method::withDocBlock');
        $this->assertInternalType('string', $source);
        $this->assertContains('$a = 42 - $value;', $source);
        $this->assertContains('return $a;', $source);
    }
    
    /**
     * Checks if getSource() returns the method signature.
     */
    public function testGetSourceReturnsMethodSignature()
    {
        $source = $this->extractor->getSource('Extractor_Method::withDocBlock');
        $this->assertInternalType('string', $source);
        $this->assertContains('public function withDocBlock($value = 7)', $source);
    }
    
    /**
     * Checks if getSource() returns the doc block of the method.
     */
    public function testGetSourceReturnsMethodDocBlock()
    {
        $source = $this->extractor->getSource('Extractor_Method::withDocBlock');
        $this->assertInternalType('string', $source);
        $this->assertContains('A method with doc block.', $source);
        $this->assertContains('@param integer $value', $source);
        $this->assertContains('@return integer', $source);
    }
    
    /**
     * Checks if getSource() returns the correct number of source lines.
     */
    public function testGetSourceReturnsCorrectNumberOfLines()
    {
        $source = $this->extractor->getSource('Extractor_Method::withDocBlock');
        $this->assertInternalType('string', $source);
        $lines = explode("\n", $source);
        $this->assertEquals(11, count($lines));
    }
    
    /**
     * Checks if getSource() always returns the same result if the parameter
     * is not changed.
     */
    public function testGetSourceIsDeterministic()
    {
        $first  = $this->extractor->getSource('Extractor_Method::withDocBlock');
        $second = $this->extractor->getSource('Extractor_Method::withDocBlock');
        $this->assertEquals($first, $second);
    }
    
    /**
     * Ensures that getSource() works even if the requested method does not
     * provide a doc block.
     */
    public function testGetSourceWorksEvenIfMethodDoesNotProvideDocBlock()
    {
        $source = $this->extractor->getSource('Extractor_Method::withoutDocBlock');
        $this->assertInternalType('string', $source);
        $this->assertNotEmpty($source);
        $this->assertNotContains('/**', $source);
    }
    
}