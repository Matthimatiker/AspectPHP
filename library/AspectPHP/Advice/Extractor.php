<?php

/**
 * AspectPHP_Advice_Extractor
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */

/**
 * Extracts advices from aspects.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 * @todo Refactor: Introduce ReflectionAspect
 */
class AspectPHP_Advice_Extractor
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
     * Extracts the advices from the given aspect.
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Advice_Container A container that contains the advices grouped by type.
     * @throws AspectPHP_Reflection_Exception If advices or pointcuts are not valid.
     */
    public function getAdvicesFrom(AspectPHP_Aspect $aspect)
    {
        $advices    = new AspectPHP_Advice_Container();
        $aspectInfo = new AspectPHP_Reflection_Aspect($aspect);
        foreach ($aspectInfo->getAdvices() as $advice) {
            /* @var $advice AspectPHP_Reflection_Advice */
            foreach ($this->supportedTags as $type) {
                /* @var $type string */
                foreach ($advice->getPointcutsByType($type) as $pointcutMethod) {
                    /* @var $pointcutMethod AspectPHP_Reflection_Pointcut */
                    $pointcut = $pointcutMethod->createPointcut($aspect);
                    $advisor  = new AspectPHP_Advice_Callback($pointcut, array($aspect, $advice->getName()));
                    $advices->{$type}()->add($advisor);
                }
            }
        }
        return $advices;
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
    
    /**
     * Checks if the given method is an internal method of AspectPHP.
     *
     * Internal method are those that are weaved into classes. These methods
     * often keep the doc comment of their prototype, but they are not marked
     * as public.
     *
     * @param ReflectionMethod $method
     * @return boolean True if the method is internal, false otherwise.
     */
    protected function isInternal(ReflectionMethod $method)
    {
        return strpos($method->getName(), '_aspectPHP') === 0;
    }
    
}