<?php

/**
 * AspectPHP_Reflection_Advice
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
 * Represents an advice method.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_Advice extends AspectPHP_Reflection_Method
{
    
    /**
     * Contains a list of supported annotation tags.
     *
     * @var array(string)
     */
    protected static $supportedTags = array(
        'before',
        'afterReturning',
        'afterThrowing',
        'after'
    );
    
    /**
     * Contains pointcut objects that were already created.
     *
     * The name of the pointcut method is used as key, the
     * pointcut object as value.
     *
     * @var array(string=>AspectPHP_Reflection_Pointcut)
     */
    protected $pointcuts = array();
    
    /**
     * Checks if the doc block contains an advice annotation.
     *
     * @param AspectPHP_Reflection_DocComment $comment
     * @return boolean True if an advice annotation was found, false otherwise.
     */
    public static function containsAdviceAnnotation(AspectPHP_Reflection_DocComment $comment)
    {
        foreach (self::$supportedTags as $tag) {
            /* @var $tag string */
            if ($comment->hasTag($tag)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Creates an advice reflection object.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @param string $name
     */
    public function __construct($aspect, $name)
    {
        parent::__construct($aspect, $name);
        $this->assertIsAdvice();
    }
    
    /**
     * Returns the referenced pointcuts for the given advice type.
     *
     * Example:
     * <code>
     * $pointcuts = $advice->getPointcutsByType('before');
     * </code>
     *
     * @param string $type
     * @return array(AspectPHP_Reflection_Pointcut)
     * @throws InvalidArgumentException If an invalid type is provided.
     */
    public function getPointcutsByType($type)
    {
        if (!in_array($type, self::$supportedTags)) {
            $message = 'Invalid type provided. Valid types are: ' . implode(', ', self::$supportedTags);
            throw new InvalidArgumentException($message);
        }
        $annotations = $this->getAdviceAnnotations();
        if (!isset($annotations[$type])) {
            return array();
        }
        return $this->getPointcutsByName($annotations[$type]);
    }
    
    /**
     * Returns the pointcuts with the provided names.
     *
     * @param array(string) $names
     * @return array(AspectPHP_Reflection_Pointcut)
     */
    protected function getPointcutsByName(array $names)
    {
        $pointcuts = array();
        foreach ($names as $name) {
            /* @var $name string */
            $pointcuts[] = $this->getPointcutByName($name);
        }
        return $pointcuts;
    }
    
    /**
     * Returns the pointcut with the provided name.
     *
     * @param string $name
     * @return AspectPHP_Reflection_Pointcut
     * @throws AspectPHP_Reflection_Exception If the aspect does not contain the requested pointcut.
     */
    protected function getPointcutByName($name)
    {
        if (!isset($this->pointcuts[$name])) {
            if (!$this->getAspect()->hasMethod($name)) {
                $message = 'Pointcut method ' . $name . '() referenced by advice %s() does not exist in aspect %s.';
                throw new AspectPHP_Reflection_Exception($this->message($message));
            }
            $this->pointcuts[$name] = new AspectPHP_Reflection_Pointcut($this->getAspect(), $name);
        }
        return $this->pointcuts[$name];
    }
    
    /**
     * Asserts that this method is an advice.
     *
     * @throws AspectPHP_Reflection_Exception If method is not a valid advice.
     */
    protected function assertIsAdvice()
    {
        if ($this->getDocComment() === false) {
            $message = 'Method %s() in aspect %s does not provide a doc comment.';
            throw new AspectPHP_Reflection_Exception($this->message($message));
        }
        if (!self::containsAdviceAnnotation($this->getDocComment())) {
            $message = 'Method %s() in aspect %s does not declare pointcut references.';
            throw new AspectPHP_Reflection_Exception($this->message($message));
        }
        if (!$this->isPublic()) {
            $message = 'Advice %s() in aspect %s must be public.';
            throw new AspectPHP_Reflection_Exception($this->message($message));
        }
        if ($this->getNumberOfRequiredParameters() > 1) {
            $message = 'Advice %s() in aspect %s must not require at most one join point parameter.';
            throw new AspectPHP_Reflection_Exception($this->message($message));
        }
    }
    
    /**
     * Returns the advice annotations from the doc comment.
     *
     * The advice type (for example "before") is used as key.
     * The value is an array of pointcut methods that are connected
     * to the advice type.
     *
     * The array contains just the advice  annotations that are present.
     * If no advice annotations were found then the array will be
     * empty.
     *
     * @return array(string=>array(string))
     * @throws AspectPHP_Reflection_Exception If no valid pointcut identifier is provided.
     */
    protected function getAdviceAnnotations()
    {
        $annotations = array();
        foreach (self::$supportedTags as $tag) {
            /* @var $tag string */
            $tagValues = $this->getDocComment()->getTags($tag);
            if (count($tagValues) === 0) {
                continue;
            }
            $annotations[$tag] = array();
            foreach ($tagValues as $pointcutReference) {
                /* @var $pointcutReference string */
                $pointcutReference = rtrim($pointcutReference, '()');
                if (empty($pointcutReference)) {
                    $message = 'No pointcut reference provided for tag @' . $tag . '.';
                    throw new AspectPHP_Reflection_Exception($message);
                }
                $annotations[$tag][] = $pointcutReference;
            }
        }
        return $annotations;
    }
    
}