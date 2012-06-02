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
     * Extracts the advices from the given aspect.
     *
     * Advices are represented by advisor objects, a combination of
     * pointcut and advice.
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Advisor_Container A container that contains advisors grouped by type.
     * @throws AspectPHP_Reflection_Exception If advices or pointcuts are not valid.
     */
    public function getAdvicesFrom(AspectPHP_Aspect $aspect)
    {
        $advisors   = new AspectPHP_Advisor_Container();
        $aspectInfo = new AspectPHP_Reflection_Aspect($aspect);
        foreach ($aspectInfo->getAdvices() as $advice) {
            /* @var $advice AspectPHP_Reflection_Advice */
            foreach (AspectPHP_Advice_Type::all() as $type) {
                /* @var $type string */
                foreach ($advice->getPointcutsByType($type) as $pointcutMethod) {
                    /* @var $pointcutMethod AspectPHP_Reflection_Pointcut */
                    $pointcut = $pointcutMethod->createPointcut($aspect);
                    $advisor  = new AspectPHP_Advisor_Callback($pointcut, array($aspect, $advice->getName()));
                    $advisors->{$type}()->add($advisor);
                }
            }
        }
        return $advisors;
    }
    
}