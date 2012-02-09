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
 * The pointcut automatically adds expression delimiters:
 * /^[...]$/
 * Where [...] is the provided expression.
 *
 *
 * Here are some usage examples.
 *
 * Match all show() methods:
 * <code>
 * $pointcut = new AspectPHP_Pointcut_RegExp('.*::show');
 * </code>
 *
 * Match all methods of the class "MyClass":
 * <code>
 * $pointcut = new AspectPHP_Pointcut_RegExp('MyClass::.*');
 * </code>
 *
 * Match all test() methods in the package Example\Demo:
 * <code>
 * $pointcut = new AspectPHP_Pointcut_RegExp('Example\Demo\.*::test');
 * </code>
 *
 * Match all getName() and setName() methods:
 * <code>
 * $pointcut = new AspectPHP_Pointcut_RegExp('.*::(get|set)Name');
 * </code>
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