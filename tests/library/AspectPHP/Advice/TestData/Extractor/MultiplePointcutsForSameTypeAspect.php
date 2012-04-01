<?php

/**
 * Extractor_MultiplePointcutsForSameTypeAspect
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.04.2012
 */

/**
 * Aspect with an advice that references multiple pointcuts for the
 * same advice type.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 01.04.2012
 */
class Extractor_MultiplePointcutsForSameTypeAspect implements AspectPHP_Aspect
{

    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutOne()
    {
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutTwo()
    {
        return new AspectPHP_Pointcut_None();
    }

    /**
     * An advice that references multiple pointcuts for the same advice type.
     *
     * @before pointcutOne()
     * @before pointcutTwo()
     */
    public function multiAdvice()
    {
    }

}