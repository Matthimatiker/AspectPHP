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
            $pointcuts[] = $this->getAspect()->getPointcut($name);
        }
        return $pointcuts;
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
        $tagList = implode('|', $this->supportedTags);
        $pattern = '/^\s*\* @(?P<type>' . $tagList . ')(( )+(?P<pointcut>.*))?$/um';
        
        $references = array();
        preg_match_all($pattern, $this->getDocComment(), $references, PREG_SET_ORDER);
    
        $annotations = array();
        foreach ($references as $reference) {
            /* @var $reference array(integer|string=>string) */
            $type = $reference['type'];
            if (!isset($reference['pointcut'])) {
                $message = 'No pointcut reference provided for tag @' . $type . '.';
                throw new AspectPHP_Reflection_Exception($message);
            }
            $pointcut = rtrim($reference['pointcut']);
            $pointcut = rtrim($pointcut, '()');
    
            if (!isset($annotations[$type])) {
                $annotations[$type] = array();
            }
            $annotations[$type][] = $pointcut;
        }
        return $annotations;
    }
    
}