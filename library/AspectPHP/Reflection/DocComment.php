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
     * Pattern that matches tags and their values.
     *
     * @var string
     */
    const TAGS_PATTERN = '/^\s*\* @(?P<name>[a-zA-Z]+)([ ]+(?P<value>.*))?\r?$/um';
    
    /**
     * The comment block.
     *
     * @var string
     */
    protected $comment = null;
    
    /**
     * Contains cached tag values grouped by tag name.
     *
     * @var array(string=>array(string))|null
     */
    protected $valuesByTagName = null;
    
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
        $tags = $this->getValuesByTagName();
        return isset($tags[$name]);
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
        if (!$this->hasTag($name)) {
            return array();
        }
        $tags = $this->getValuesByTagName();
        return $tags[$name];
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
    
    /**
     * Returns the values grouped by tag name.
     *
     * The tag name is used as key, the assigned value
     * is an array of tag values.
     *
     * @return array(string=>array(string))
     */
    protected function getValuesByTagName()
    {
        if ($this->valuesByTagName === null) {
            $this->valuesByTagName = $this->findValuesByTagName();
        }
        return $this->valuesByTagName;
    }
    
    /**
     * Extracts the tags from the comment.
     *
     * The tag name is used as key, the assigned value
     * is an array of tag values.
     *
     * @return array(string=>array(string))
     */
    protected function findValuesByTagName()
    {
        $tags = array();
        preg_match_all(self::TAGS_PATTERN, $this->comment, $tags, PREG_SET_ORDER);
        
        $valuesByTag = array();
        foreach ($tags as $tag) {
            /* @var $tag array(string=>string) */
            $name = $tag['name'];
            if (!isset($valuesByTag[$name])) {
                $valuesByTag[$name] = array();
            }
            $value = isset($tag['value']) ? $this->sanitizeTagValue($tag['value']) : '';
            $valuesByTag[$name][] = $value;
        }
        return $valuesByTag;
    }
    
    /**
     * Sanitizes the provided tag value.
     *
     * @param string $value
     * @return string The sanitized value.
     */
    protected function sanitizeTagValue($value)
    {
        return rtrim($value);
    }
    
}