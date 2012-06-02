<?php

/**
 * AspectPHP_Advisor_Composite
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */

/**
 * Class that encapsulates multiple advisors and behaves like a single advisor.
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 28.03.2012
 */
class AspectPHP_Advisor_Composite implements AspectPHP_Advisor, AspectPHP_Pointcut, IteratorAggregate, Countable
{
    
    /**
     * A list of all added advisors.
     *
     * @var array(AspectPHP_Advisor)
     */
    protected $advisors = array();
    
    /**
     * See {@link AspectPHP_Advisor::getPointcut()} for details.
     *
     * @return AspectPHP_Pointcut
     */
    public function getPointcut()
    {
        return $this;
    }
    
    /**
     * See {@link AspectPHP_Advisor::invoke()} for details.
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function invoke(AspectPHP_JoinPoint $joinPoint)
    {
        foreach ($this->advisors as $advisor) {
            /* @var $advisor AspectPHP_Advisor */
            $advisor->invoke($joinPoint);
        }
    }
    
    /**
     * Adds the provided advisor to the composite.
     *
     * @param AspectPHP_Advisor $advisor
     * @return AspectPHP_Advisor_Composite Provides a fluent interface.
     */
    public function add(AspectPHP_Advisor $advisor)
    {
        $this->advisors[] = $advisor;
        return $this;
    }
    
    /**
     * Merges all advisors of the given composite into this composite.
     *
     * The given composite is not modified.
     *
     * @param AspectPHP_Advisor_Composite $composite
     * @return AspectPHP_Advisor_Composite Provides a fluent interface.
     */
    public function merge(AspectPHP_Advisor_Composite $composite)
    {
        $this->advisors = array_merge($this->advisors, $composite->advisors);
        return $this;
    }
    
    /**
     * Returns the number of registered advisors.
     *
     * @return integer
     */
    public function count()
    {
        return count($this->advisors);
    }
    
    /**
     * Returns an iterator that is used to iterate over all advisors
     * in this composite.
     *
     * @return Iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->advisors);
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
        foreach ($this->advisors as $advisor) {
            /* @var $advisor AspectPHP_Advisor */
            if (!$advisor->getPointcut()->matches($method)) {
                return false;
            }
        }
        return true;
    }
    
}