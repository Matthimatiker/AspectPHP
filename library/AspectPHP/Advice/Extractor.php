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
    
}