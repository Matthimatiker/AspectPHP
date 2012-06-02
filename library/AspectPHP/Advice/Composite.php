<?php

/**
 * AspectPHP_Advice_Composite
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */

/**
 * Class that encapsulates multiple advices and behaves like a single advice.
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */
class AspectPHP_Advice_Composite implements AspectPHP_Advisor, AspectPHP_Pointcut, IteratorAggregate, Countable
{
    
    /**
     * A list of all added advices.
     *
     * @var array(AspectPHP_Advice)
     */
    protected $advices = array();
    
    /**
     * See {@link AspectPHP_Advice::getPointcut()} for details.
     *
     * @return AspectPHP_Pointcut
     */
    public function getPointcut()
    {
        return $this;
    }
    
    /**
     * See {@link AspectPHP_Advice::invoke()} for details.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function invoke(AspectPHP_JoinPoint $joinPoint)
    {
        foreach ($this->advices as $advice) {
            /* @var $advice AspectPHP_Advice */
            $advice->invoke($joinPoint);
        }
    }
    
    /**
     * Adds the provided advice to the composite.
     *
     * @param AspectPHP_Advice $advice
     * @return AspectPHP_Advice_Composite Provides a fluent interface.
     */
    public function add(AspectPHP_Advice $advice)
    {
        $this->advices[] = $advice;
        return $this;
    }
    
    /**
     * Merges all advices of the given composite into this composite.
     *
     * The given composite is not modified.
     *
     * @param AspectPHP_Advice_Composite $composite
     * @return AspectPHP_Advice_Composite Provides a fluent interface.
     */
    public function merge(AspectPHP_Advice_Composite $composite)
    {
        $this->advices = array_merge($this->advices, $composite->advices);
        return $this;
    }
    
    /**
     * Returns the number of registered advices.
     *
     * @return integer
     */
    public function count()
    {
        return count($this->advices);
    }
    
    /**
     * Returns an iterator that is used to iterate over all advices
     * in this composite.
     *
     * @return Iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->advices);
    }
    
    /**
     * See {@link AspectPHP_Pointcut::matches()} for details.
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        if (count($this) === 0) {
            return false;
        }
        foreach ($this->advices as $advice) {
            /* @var $advice AspectPHP_Advice */
            if (!$advice->getPointcut()->matches($method)) {
                return false;
            }
        }
        return true;
    }
    
}