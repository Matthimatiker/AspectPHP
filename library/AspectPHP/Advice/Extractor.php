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
     * @throws RuntimeException If advices or pointcuts are not valid.
     */
    public function getAdvicesFrom(AspectPHP_Aspect $aspect)
    {
        $advices    = new AspectPHP_Advice_Container();
        $aspectInfo = new ReflectionClass($aspect);
        foreach ($aspectInfo->getMethods() as $method) {
            /* @var $method ReflectionMethod */
            $docComment = $method->getDocComment();
            if ($docComment === false) {
                // Method does not provide a doc comment.
                continue;
            }
            $annotations = $this->getAdviceAnnotations($docComment);
            if (count($annotations) === 0) {
                // No advice annotations found.
                continue;
            }
            // Advice method found, perform further checks.
            if (!$method->isPublic()) {
                throw new RuntimeException('Advice '. $method . ' must be public.');
            }
            foreach ($annotations as $type => $pointcuts) {
                /* @var $type string */
                /* @var $pointcuts array(string) */
                foreach ($pointcuts as $pointcut) {
                    /* @var $pointcut string */
                    if (!$aspectInfo->hasMethod($pointcut)) {
                        $message = 'Pointcut method %s referenced by advice %s does not exist.';
                        $message = sprintf($message, $pointcut, $method);
                        throw new RuntimeException($message);
                    }
                    /* @var $pointcutMethod ReflectionMethod */
                    $pointcutMethod = $aspectInfo->getMethod($pointcut);
                    if (!$pointcutMethod->isPublic()) {
                        $message = 'Pointcut method %s referenced by advice %s must be public.';
                        $message = sprintf($message, $pointcut, $method);
                        throw new RuntimeException($message);
                    }
                    $pointcutObject = $pointcutMethod->invoke($aspect);
                    if (!($pointcutObject instanceof AspectPHP_Pointcut)) {
                        $message = 'Pointcut method %s referenced by advice %s must return an instance '
                                 . 'of AspectPHP_Pointcut.';
                        $message = sprintf($message, $pointcut, $method);
                        throw new RuntimeException($message);
                    }
                    // Advice and pointcut method are valid, therefore create and add an advice object.
                    $advice = new AspectPHP_Advice_Callback($pointcutObject, array($aspect, $method->getName()));
                    $advices->{$type}()->add($advice);
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
    
}