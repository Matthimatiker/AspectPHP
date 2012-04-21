<?php

/**
 * AspectPHP_Reflection_DocCommentTest
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 17.04.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the doc comment reflection class.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 17.04.2012
 */
class AspectPHP_Reflection_DocCommentTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Reflection_DocComment
     */
    protected $docComment = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->docComment = new AspectPHP_Reflection_DocComment($this->getComment());
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->docComment = null;
        parent::tearDown();
    }
    
    /**
     * Ensures that the constructor throws an exception if no string is passed
     * to the constructor.
     */
    public function testConstructorThrowsExceptionIfInvalidArgumentIsPassed()
    {
        $this->setExpectedException('InvalidArgumentException');
        new AspectPHP_Reflection_DocComment(new stdClass());
    }
    
    /**
     * Checks if the magic __toString() method returns the original comment
     * that was used to create the object.
     */
    public function testToStringReturnsOriginalComment()
    {
        $this->assertEquals($this->getComment(), (string)$this->docComment);
    }
    
    public function testHasTagReturnsFalseIfCommentDoesNotContainTag()
    {
        
    }
    
    public function testHasTagReturnsTrueIfCommentContainsTag()
    {
    
    }
    
    public function testGetTagsReturnsArray()
    {
        
    }
    
    public function testGetTagsReturnsEmptyArrayIfCommentDoesNotContainTags()
    {
        
    }
    
    public function testGetTagsReturnsArrayWithCorrectNumberOfElements()
    {
    
    }
    
    public function testGetTagsReturnsArrayWithEmptyStringIfTagDoesNotContainAnyValue()
    {
        
    }
    
    public function testGetTagsReturnsArrayWithCorrectValues()
    {
        
    }
    
    /**
     * Returns a comment string for testing.
     *
     * @return string
     */
    protected function getComment()
    {
        $comment = '/**'                              . PHP_EOL
                 . ' * This is a comment.'            . PHP_EOL
                 . ' *'                               . PHP_EOL
                 . ' * This is the long description.' . PHP_EOL
                 . ' *'                               . PHP_EOL
                 . ' * @param JoinPoint $joinPoint'   . PHP_EOL
                 . ' * @param mixed|null $context'    . PHP_EOL
                 . ' * @return string'                . PHP_EOL
                 . ' * @afterThrowing myPointcut()'   . PHP_EOL
                 . ' * @tagged'                       . PHP_EOL
                 . ' */'                              . PHP_EOL;
        return $comment;
    }
    
}