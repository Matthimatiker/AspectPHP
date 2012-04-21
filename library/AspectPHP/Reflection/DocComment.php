<?php

/**
 * AspectPHP_Reflection_DocComment
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.04.2012
 */

/**
 * Represents a doc comment.
 *
 * Provides method to extract information from the comment.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 16.04.2012
 */
class AspectPHP_Reflection_DocComment
{
    
    /**
     * The comment block.
     *
     * @var string
     */
    protected $comment = null;
    
    /**
     * Creates a comment object.
     *
     * @param string $comment The doc block comment.
     * @throws InvalidArgumentException If no string is passed.
     */
    public function __construct($comment)
    {
        if (!is_string($comment)) {
            throw new InvalidArgumentException('Comment must be a string.');
        }
        $this->comment = $comment;
    }
    
    /**
     * Checks if the comment contains a tag with the provided name.
     *
     * Example:
     * <code>
     * $isAvailable = $comment->hasTag('return');
     * </code>
     *
     * @param string $name
     * @return boolean True if the tag exists, false otherwise.
     */
    public function hasTag($name)
    {
        
    }
    
    /**
     * Returns the values that are assigned to the tags
     * with the provided name.
     *
     * Returns an array of values as each tag may occur more than once.
     *
     * Example:
     * <code>
     * $values = $comment->getTags('param');
     * </code>
     *
     * @param string $name
     * @return array(string)
     */
    public function getTags($name)
    {
        
    }
    
    /**
     * Returns the comment.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->comment;
    }
    
}