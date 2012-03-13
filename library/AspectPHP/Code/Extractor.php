<?php

/**
 * AspectPHP_Code_Extractor
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 11.02.2012
 */

/**
 * Helper class that may be used to extract source code.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Code
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 11.02.2012
 */
class AspectPHP_Code_Extractor {
    
    /**
     * Returns the source code of the given method.
     *
     * Example:
     * <code>
     * // Source contains something like "public function myMethod() {[...]".
     * $source = $extractor->getSource('MyClass::myMethod');
     * </code>
     *
     * @param string $methodIdentifier The method identifier.
     * @return string The extracted source code.
     * @throws InvalidArgumentException If the method does not exist.
     */
    public function getSource($methodIdentifier)
    {
        $parts = explode('::', $methodIdentifier);
        if (count($parts) !== 2) {
            throw new InvalidArgumentException('Method identifier expected.');
        }
        list($class, $method) = $parts;
        if (!class_exists($class, true)) {
            throw new InvalidArgumentException('Class "' . $class . '" does not exist.');
        }
        $reflection = new ReflectionClass($class);
        if (!$reflection->hasMethod($method)) {
            throw new InvalidArgumentException('Method "' . $method . '" does not exist in class "' . $class . '".');
        }
        $methodReflection = $reflection->getMethod($method);
        $docBlock         = $methodReflection->getDocComment();
        $fullSource       = file($methodReflection->getFileName());
        $linesOfCode      = $methodReflection->getEndLine() - $methodReflection->getStartLine() + 1;
        $methodSource     = array_slice($fullSource, $methodReflection->getStartLine() - 1, $linesOfCode);
        $methodSource     = implode('', $methodSource);
        return '    ' . $docBlock . PHP_EOL . rtrim($methodSource);
    }
    
}

?>