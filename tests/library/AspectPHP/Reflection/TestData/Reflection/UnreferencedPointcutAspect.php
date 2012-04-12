<?php

/**
 * Reflection_UnreferencedPointcutAspect
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 12.04.2012
 */

/**
 * Aspect that contains a pointcut that is not referenced by any advice,
 * but prefixed by "pointcut".
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 12.04.2012
 */
class Reflection_UnreferencedPointcutAspect implements AspectPHP_Aspect
{
    
    /**
     * A pointcut that is referenced by an advice.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutUnreferencedPointcut()
    {
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * A pointcut that is not referenced by any advice.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutReferencedPointcut()
    {
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * A dummy advice.
     *
     * @after pointcutReferencedPointcut()
     */
    public function afterAdvice()
    {
    }
    
}