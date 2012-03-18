<?php

/**
 * AspectPHP_Pointcut_RegExp
 *
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
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
 * @package AspectPHP_Pointcut
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 09.02.2012
 */
class AspectPHP_Pointcut_RegExp implements AspectPHP_Pointcut
{
    
    /**
     * The regular expression that is used to check the methods.
     *
     * @var string
     */
    protected $regExp = null;
    
    /**
     * Creates a pointcut that uses the given regular expression.
     *
     * @param string $expression
     * @throws InvalidArgumentException If no valid expression is provided.
     */
    public function __construct($expression)
    {
        if (!is_string($expression) || empty($expression)) {
            $message = 'Expected regular expression (non-empty string).';
            throw new InvalidArgumentException($message);
        }
        $this->regExp = $this->toRegExp($expression);
    }
    
    /**
     * See {@link AspectPHP_Pointcut::matches()} for details.
     *
     * @param string $method
     * @return boolean
     */
    public function matches($method)
    {
        return preg_match($this->regExp, $method) === 1;
    }
    
    /**
     * Converts the given expression to a real regular expression.
     *
     * @param string $expression
     * @return string
     */
    protected function toRegExp($expression)
    {
        // Escape namespace and class/method separators.
        $replacePairs = array(
            '\\' => '\\\\',
            '::' => '\:\:'
        );
        $regExp = str_replace(array_keys($replacePairs), array_values($replacePairs), $expression);
        $regExp = '/^' . $regExp . '$/';
        return $regExp;
    }
    
}