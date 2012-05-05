<?php

/**
 * AspectPHP_Reflection_Aspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 09.04.2012
 */

/**
 * Reflection class that is used to gather information about an aspect.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 09.04.2012
 */
class AspectPHP_Reflection_Aspect extends ReflectionClass
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
     * A list of methods that are considered as pointcut.
     *
     * The method name is used as key to provided fast access by name.
     *
     * @var array(string=>AspectPHP_Reflection_Pointcut)
     */
    protected $pointcuts = array();
    
    /**
     * A list of methods that are considered as advice.
     *
     * The method name is used as key to provided fast access by name.
     *
     * @var array(string=>AspectPHP_Reflection_Advice)
     */
    protected $advices = array();
    
    /**
     * Creates a reflection object that is used to inspect
     * the provided aspect.
     *
     * The constructor accepts an aspect object or the name
     * of an aspect class.
     *
     * @param AspectPHP_Aspect|string $classOrAspect
     * @throws AspectPHP_Reflection_Exception If an invalid argument is provided.
     */
    public function __construct($classOrAspect)
    {
        parent::__construct($classOrAspect);
        if (!$this->implementsInterface('AspectPHP_Aspect')) {
            $message = 'Class ' . $this->getName() . ' is not an aspect.';
            throw new AspectPHP_Reflection_Exception($message);
        }
        $this->determineAdvicesAndPointcuts();
    }
    
    /**
     * Returns all pointcut methods.
     *
     * A method is considered as pointcut if it starts with the
     * prefix "pointcut" or if it is referenced by an advice.
     *
     * @return array(AspectPHP_Reflection_Pointcut)
     */
    public function getPointcuts()
    {
        return array_values($this->pointcuts);
    }
    
    /**
     * Returns the pointcut method with the provided name.
     *
     * @param string $name
     * @return AspectPHP_Reflection_Pointcut
     * @throws AspectPHP_Reflection_Exception If the requested method is not considered as pointcut.
     */
    public function getPointcut($name)
    {
        if (!$this->hasPointcut($name)) {
            $message = 'Pointcut ' . $name . ' does not exist.';
            throw new AspectPHP_Reflection_Exception($message);
        }
        return $this->pointcuts[$name];
    }
    
    /**
     * Checks if the aspect contains a pointcut with the provided name.
     *
     * @param string $name
     * @return boolean True if the pointcut exists, false otherwise.
     */
    public function hasPointcut($name)
    {
        return isset($this->pointcuts[$name]);
    }
    
    /**
     * Returns all advice methods.
     *
     * A method is considered as advice method if it references
     * a pointcut via annotations.
     *
     * @return array(AspectPHP_Reflection_Advice)
     */
    public function getAdvices()
    {
        return array_values($this->advices);
    }
    
    /**
     * Returns the advice method with the provided name.
     *
     * @param string $name
     * @return AspectPHP_Reflection_Advice
     * @throws AspectPHP_Reflection_Exception If the requested method is not considered as advice.
     */
    public function getAdvice($name)
    {
        if (!$this->hasAdvice($name)) {
            $message = 'Advice ' . $name . ' does not exist.';
            throw new AspectPHP_Reflection_Exception($message);
        }
        return $this->advices[$name];
    }
    
    /**
     * Checks if the aspect contains an advice with the provided name.
     *
     * @param string $name
     * @return boolean True if the advice exists, false otherwise.
     */
    public function hasAdvice($name)
    {
        return isset($this->advices[$name]);
    }
    
    /**
     * Searches for pointcut/advice methods and stores them in the
     * corresponding object attribute.
     */
    protected function determineAdvicesAndPointcuts()
    {
        foreach ($this->getMethods() as $method) {
            /* @var $method ReflectionMethod */
            if ($this->isFrameworkMethod($method)) {
                // Skips internal methods of the AspectPHP framework.
                continue;
            }
            if ($this->isPointcut($method)) {
                $this->addPointcut($method);
                continue;
            }
            if ($this->isAdvice($method)) {
                $this->addAdvice($method);
                continue;
            }
        }
    }
    
    /**
     * Adds the method to the pointcut list.
     *
     * @param ReflectionMethod $method
     * @throws AspectPHP_Reflection_Exception If the method does not meet the pointcut requirements.
     */
    protected function addPointcut(ReflectionMethod $method)
    {
        if (isset($this->pointcuts[$method->getName()])) {
            // Pointcut is already known, do not overwrite it.
            return;
        }
        $this->pointcuts[$method->getName()] = $this->toPointcut($method);
    }
    
    /**
     * Converts the provided method into a pointcut reflection object.
     *
     * @param ReflectionMethod|AspectPHP_Reflection_Pointcut $method
     * @return AspectPHP_Reflection_Pointcut
     * @throws AspectPHP_Reflection_Exception If the method does not meet the pointcut requirements.
     */
    protected function toPointcut(ReflectionMethod $method)
    {
        if ($method instanceof AspectPHP_Reflection_Pointcut) {
            return $method;
        }
        return new AspectPHP_Reflection_Pointcut($this, $method->getName());
    }
    
    /**
     * Adds the method to the advice list.
     *
     * @param ReflectionMethod $method
     * @throws AspectPHP_Reflection_Exception If a referenced pointcut method does not exist.
     */
    protected function addAdvice(ReflectionMethod $method)
    {
        $advice = new AspectPHP_Reflection_Advice($this, $method->getName());
        foreach ($this->supportedTags as $type) {
            /* @var $type string */
            foreach ($advice->getPointcutsByType($type) as $pointcut) {
                /* @var $pointcut AspectPHP_Reflection_Pointcut */
                $this->addPointcut($pointcut);
            }
        }
        $this->advices[$advice->getName()] = $advice;
    }
    
    /**
     * Checks if the provided method is considered as advice.
     *
     * @param ReflectionMethod $method
     * @return boolean True if the method is considered as advice, false otherwise.
     */
    protected function isAdvice(ReflectionMethod $method)
    {
        $docComment = $method->getDocComment();
        if ($docComment === false) {
            // Advices must contain a doc comment.
            return false;
        }
        if (!AspectPHP_Reflection_Advice::referencesPointcut($docComment)) {
            // No advice annotations found.
            return false;
        }
        return true;
    }
    
    /**
     * Checks if the method is marked as pointcut.
     *
     * Methods that start with "pointcut" are considered as pointcuts.
     *
     * @param ReflectionMethod $method
     * @return boolean True if the method is considered as pointcut, false otherwise.
     */
    protected function isPointcut(ReflectionMethod $method)
    {
        return strpos($method->getName(), 'pointcut') === 0;
    }
    
    /**
     * Checks if the given method is an internal method of the AspectPHP framework.
     *
     * Internal methods are those that are weaved into classes. These methods
     * often keep the doc comment of their prototype, but they are not marked
     * as public.
     *
     * @param ReflectionMethod $method
     * @return boolean True if the method is internal, false otherwise.
     */
    protected function isFrameworkMethod(ReflectionMethod $method)
    {
        return strpos($method->getName(), '_aspectPHP') === 0;
    }
    
}