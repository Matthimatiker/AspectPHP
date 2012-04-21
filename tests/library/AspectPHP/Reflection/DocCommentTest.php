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
    
    /**
     * Ensures that hasTag() returns false if the comment does not contain a
     * tag with the provided name.
     */
    public function testHasTagReturnsFalseIfCommentDoesNotContainTag()
    {
        
    }
    
    /**
     * Ensures that hasTag() returns true if the comment contains a tag with
     * the provided name.
     */
    public function testHasTagReturnsTrueIfCommentContainsTag()
    {
    
    }
    
    /**
     * Ensures that hasTag() returns true if the comment contains a tag with
     * the provided name, even if no tag value is assigned.
     */
    public function testHasTagReturnsTrueIfCommentContainsTagWithoutValue()
    {
        
    }
    
    /**
     * Checks if getTags() returns an array.
     */
    public function testGetTagsReturnsArray()
    {
        
    }
    
    /**
     * Ensures that getTags() returns an empty array if the comment does not
     * contain any tag with the provided name.
     */
    public function testGetTagsReturnsEmptyArrayIfCommentDoesNotContainTags()
    {
        
    }
    
    /**
     * Checks if getTags() returns an array that contains as many elements as
     * there are tags in the comment.
     */
    public function testGetTagsReturnsArrayWithCorrectNumberOfElements()
    {
    
    }
    
    /**
     * Ensures that getTags() returns an empty string as tag value if no value
     * was assigned to the tag with the provided name.
     */
    public function testGetTagsReturnsArrayWithEmptyStringIfTagDoesNotContainAnyValue()
    {
        
    }
    
    /**
     * Checks if the array from getTags() contains the correct values.
     */
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