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
    protected $supportedTags = array(
        'before',
        'afterReturning',
        'afterThrowing',
        'after'
    );
    
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
        if (!in_array($type, $this->supportedTags)) {
            $message = 'Invalid type provided. Valid types are: ' . implode(', ', $this->supportedTags);
            throw new InvalidArgumentException($message);
        }
        return array();
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
        if (!$this->containsAdviceAnnotation()) {
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
     * Checks if the doc block contains an advice annotation.
     *
     * @return boolean True if an advice annotation was found, false otherwise.
     */
    protected function containsAdviceAnnotation()
    {
    
        $tagList = implode('|', $this->supportedTags);
        $pattern = '/\* @(' . $tagList . ')\s/u';
        return preg_match($pattern, $this->getDocComment()) !== 0;
    }
    
}