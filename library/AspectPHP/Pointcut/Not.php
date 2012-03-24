<?php

/**
 * AspectPHP_Pointcut_Not
 *
 * @category PHP
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.03.2012
 */

/**
 * Pointcut that negates the result of its inner pointcut.
 *
 * Example:
 * <code>
 * $inner = new AspectPHP_Pointcut_All();
 * $not   = new AspectPHP_Pointcut_Not($inner);
 * // Returns true:
 * $inner->matches('Demo::method');
 * // Returns false:
 * $not->matches('Demo::method');
 * </code>
 *
 * @category PHP
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 24.03.2012
 */
class AspectPHP_Pointcut_Not implements AspectPHP_Pointcut
{
    
    /**
     * The inner pointcut.
     *
     * @var AspectPHP_Pointcut
     */
    protected $inner = null;
    
    /**
     * Creates a Not pointcut that inverts the result of the pointcut $inner.
     *
     * @param AspectPHP_Pointcut $inner
     */
    public function __construct(AspectPHP_Pointcut $inner)
    {
        $this->inner = $inner;
    }
    
    /**
     * See {@link AspectPHP_Pointcut::matches()} for details.
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        return !$this->inner->matches($method);
    }
    
}