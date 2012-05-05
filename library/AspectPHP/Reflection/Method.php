<?php

/**
 * AspectPHP_Reflection_Method
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */

/**
 * Class for methods that belong to an aspect.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_Method extends ReflectionMethod
{
    
    /**
     * The aspect that contains the method.
     *
     * @var AspectPHP_Reflection_Aspect
     */
    protected $aspect = null;
    
    /**
     * The cached doc comment.
     *
     * Contains...
     * # null if the doc comment was not cached yet.
     * # false if no doc comment is available.
     * # the cached object otherwise.
     *
     * @var AspectPHP_Reflection_DocComment|false|null
     */
    protected $docComment = null;
    
    /**
     * Creates a method reflection object.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @param string $name
     */
    public function __construct($aspect, $name)
    {
        $this->aspect = $this->toReflection($aspect);
        parent::__construct($this->aspect->getName(), $name);
    }
    
    /**
     * Returns information about the aspect that declares this method.
     *
     * @return AspectPHP_Reflection_Aspect
     */
    public function getAspect()
    {
        return $this->aspect;
    }
    
    /**
     * Returns a doc comment object or false if no doc block exists.
     *
     * Notice:
     * The return value false is used to be compatible to the overwritten
     * method ReflectionMethod::getDocComment(). Usually null would
     * be the preferred return value if an object is not available.
     *
     * @return AspectPHP_Reflection_DocComment|false
     */
    public function getDocComment()
    {
        if ($this->docComment === null) {
            $this->docComment = $this->createDocComment();
        }
        return $this->docComment;
    }
    
    /**
     * Checks if the method has a doc block.
     *
     * @return boolean True if a doc comment is available, false otherwise.
     */
    public function hasDocComment()
    {
        
    }
    
    /**
     * Creates the doc comment object.
     *
     * @return AspectPHP_Reflection_DocComment|false
     */
    protected function createDocComment()
    {
        $comment = parent::getDocComment();
        if ($comment === false) {
            return false;
        }
        return new AspectPHP_Reflection_DocComment($comment);
    }
    
    /**
     * Adds infos to the given message.
     *
     * Adds the following parameters (in this order):
     * # method name
     * # aspect name
     *
     * Example:
     * <code>
     * $message = $this->message('Method %s in aspect %s.');
     * </code>
     *
     * @param string $message
     * @return string
     */
    protected function message($message)
    {
        return sprintf($message, $this->getName(), $this->aspect->getName());
    }
    
    /**
     * Returns a reflection object for the provided aspect.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @return AspectPHP_Reflection_Aspect
     * @throws AspectPHP_Reflection_Exception If invalid aspect data is provided.
     */
    protected function toReflection($aspect)
    {
        if ($aspect instanceof AspectPHP_Reflection_Aspect) {
            // Use existing reflection object.
            return $aspect;
        }
        return new AspectPHP_Reflection_Aspect($aspect);
    }
    
}