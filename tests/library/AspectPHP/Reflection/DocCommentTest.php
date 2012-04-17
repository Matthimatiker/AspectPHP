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
     * Returns a comment string for testing.
     *
     * @return string
     */
    protected function getComment()
    {
        $comment = '/**'
                 . ' * This is a comment.'
                 . ' *'
                 . ' * This is the long description.'
                 . ' *'
                 . ' * @param JoinPoint $joinPoint'
                 . ' * @param mixed|null $context'
                 . ' * @return string'
                 . ' * @afterThrowing myPointcut()'
                 . ' * @tagged'
                 . ' */';
        return $comment;
    }
    
}