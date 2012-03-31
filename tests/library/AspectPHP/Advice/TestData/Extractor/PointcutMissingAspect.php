<?php

/**
 * Extractor_PointcutMissingAspect
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */

/**
 * An aspect with reference to a missing pointcut.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 31.03.2012
 */
class Extractor_PointcutMissingAspect implements AspectPHP_Aspect
{
    
    /**
     * An advice that references a not existing pointcut.
     *
     * @before pointcut()
     */
    public function beforeAdvice()
    {
    }
    
}