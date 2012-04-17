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
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
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