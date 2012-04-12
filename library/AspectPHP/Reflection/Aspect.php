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
     * @var array(string=>ReflectionMethod)
     */
    protected $pointcuts = array();
    
    /**
     * A list of methods that are considered as advice.
     *
     * The method name is used as key to provided fast access by name.
     *
     * @var array(string=>ReflectionMethod)
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
            $message = 'Provided class/object is not an aspect.';
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
     * @return array(ReflectionMethod)
     */
    public function getPointcuts()
    {
        return array_values($this->pointcuts);
    }
    
    /**
     * Returns the pointcut method with the provided name.
     *
     * @param string $name
     * @return ReflectionMethod
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
     * @return array(ReflectionMethod)
     */
    public function getAdvices()
    {
        return array_values($this->advices);
    }
    
    /**
     * Returns the advice method with the provided name.
     *
     * @param string $name
     * @return ReflectionMethod
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
     */
    protected function addPointcut(ReflectionMethod $method)
    {
        $this->pointcuts[$method->getName()] = $method;
    }
    
    /**
     * Adds the method to the advice list.
     *
     * @param ReflectionMethod $method
     * @throws AspectPHP_Reflection_Exception If a referenced pointcut method does not exist.
     */
    protected function addAdvice(ReflectionMethod $method)
    {
        $annotations = $this->getAdviceAnnotations($method->getDocComment());
        foreach ($annotations as $type => $pointcuts) {
            /* @var $type string */
            /* @var $pointcuts array(string) */
            foreach ($pointcuts as $pointcut) {
                /* @var $pointcut string */
                if (!$this->hasMethod($pointcut)) {
                    $message = 'Pointcut method %s() referenced by advice %s() does not exist.';
                    $message = sprintf($message, $pointcut, $method->getName());
                    throw new AspectPHP_Reflection_Exception($message);
                }
                $this->addPointcut($this->getMethod($pointcut));
            }
        }
        $this->advices[$method->getName()] = $method;
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
        if (!$this->containsAdviceAnnotation($docComment)) {
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
     * Checks if the provided doc block contains an advice annotation.
     *
     * @param string $docComment
     * @return boolean True if an advice annotation was found, false otherwise.
     */
    protected function containsAdviceAnnotation($docComment)
    {
        return count($this->getAdviceAnnotations($docComment)) > 0;
    }
    
    /**
     * Returns the advice annotations from the given doc comment.
     *
     * The advice type (for example "before") is used as key.
     * The value is an array of pointcut methods that are connected
     * to the advice type.
     *
     * The array contains just the advice  annotations that are present.
     * If no advice annotations were found then the array will be
     * empty.
     *
     * @param string $docComment
     * @return array(string=>array(string))
     */
    protected function getAdviceAnnotations($docComment)
    {
        $annotations = array();
        $lines       = explode("\n", $docComment);
        foreach ($lines as $line) {
            /* @var $line string */
            if (strpos($line, '@') === false) {
                // Line does not contain a tag.
                continue;
            }
            // Line may contain an annotation.
            $line = trim($line);
            $line = ltrim($line, '* ');
            foreach ($this->supportedTags as $tag) {
                /* @var $tag string */
                if (strpos($line, '@' . $tag . ' ') !== 0) {
                    // Line does not start with tag.
                    continue;
                }
                // Tag found, extract information.
                $parts = explode(' ', $line, 2);
                if (!isset($annotations[$tag])) {
                    $annotations[$tag] = array();
                }
                $pointcut = $parts[1];
                $pointcut = ltrim($pointcut);
                $pointcut = rtrim($pointcut, '()');
                $annotations[$tag][] = $pointcut;
            }
        }
        return $annotations;
    }
    
}