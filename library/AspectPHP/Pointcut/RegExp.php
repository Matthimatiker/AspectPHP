<?php

/**
 * AspectPHP_Pointcut_RegExp
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */

/**
 * Pointcut that uses regular expressions to match methods.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */
class AspectPHP_Pointcut_RegExp implements AspectPHP_Pointcut {
    
    /**
     * Creates a pointcut that uses the given regular expression.
     *
     * @param string $expression
     * @throws InvalidArgumentException If no valid expression is provided.
     */
    public function __construct($expression) {
        
    }
    
    /**
     * @see AspectPHP_Pointcut::matches()
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method) {
        
    }
    
}

?>