<?php

/**
 * Extractor_NoDocCommentAspect
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
 * An aspect that contains a method without doc comment.
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
class Extractor_NoDocCommentAspect implements AspectPHP_Aspect
{
    
    public function notDocumentedMethod()
    {
    }
    
    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcut()
    {
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * A dummy advice.
     *
     * @before pointcut()
     */
    public function beforeAdvice()
    {
    }
    
}