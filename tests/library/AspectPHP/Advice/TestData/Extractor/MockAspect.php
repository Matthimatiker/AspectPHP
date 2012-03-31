<?php

/**
 * Extractor_MockAspect
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
 * Mock class that is used to test the advice extractor.
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
class Extractor_MockAspect implements AspectPHP_Aspect
{
    
    /**
     * Contains the names of called methods.
     *
     * The list is ordered by time of invocation.
     *
     * @var array(string)
     */
    protected $calledMethods = array();
    
    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutOne()
    {
        $this->trackCall(__FUNCTION__);
        return new AspectPHP_Pointcut_All();
    }
    
    /**
     * Returns a pointcut.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutTwo()
    {
        $this->trackCall(__FUNCTION__);
        return new AspectPHP_Pointcut_None();
    }
    
    /**
     * First before advice.
     *
     * @before pointcutOne()
     */
    public function adviceBeforeOne()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * Second before advice.
     *
     * @before pointcutTwo()
     */
    public function adviceBeforeTwo()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * First afterReturning advice.
     *
     * @afterReturning pointcutOne()
     */
    public function adviceAfterReturningOne()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * Second afterReturning advice.
     *
     * @afterReturning pointcutTwo()
     */
    public function adviceAfterReturningTwo()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * First afterThrowing advice.
     *
     * @afterThrowing pointcutOne()
     */
    public function adviceAfterThrowingOne()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * Second afterThrowing advice.
     *
     * @afterThrowing pointcutTwo()
     */
    public function adviceAfterThrowingTwo()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * First after advice.
     *
     * @after pointcutOne()
     */
    public function adviceAfterOne()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * Second after advice.
     *
     * @after pointcutTwo()
     */
    public function adviceAfterTwo()
    {
        $this->trackCall(__FUNCTION__);
    }
    
    /**
     * Tracks the call of the given method.
     *
     * @param string $method
     */
    protected function trackCall($method)
    {
        $this->calledMethods[] = $method;
    }
    
    /**
     * Returns a list of the called methods.
     *
     * @return array(string)
     */
    public function getCalledMethods()
    {
        return $this->calledMethods;
    }
    
}