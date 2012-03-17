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
class AspectPHP_Code_Extractor
{
    
    /**
     * Cached source code by method identifier.
     *
     * The identifier is used as key, the source code as value.
     *
     * @var array(string=>string)
     */
    protected $sourceByMethod = array();
    
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
        if (!isset($this->sourceByMethod[$methodIdentifier])) {
            $reflection = $this->toReflectionObject($methodIdentifier);
            $this->sourceByMethod[$methodIdentifier] = $this->extractCode($reflection);
        }
        return $this->sourceByMethod[$methodIdentifier];
    }
    
    /**
     * Extracts the source code of the given method.
     *
     * @param ReflectionMethod $reflection
     * @return string The source code.
     */
    protected function extractCode(ReflectionMethod $reflection)
    {
        $fullSource  = file($reflection->getFileName());
        $linesOfCode = $reflection->getEndLine() - $reflection->getStartLine() + 1;
        $source      = array_slice($fullSource, $reflection->getStartLine() - 1, $linesOfCode);
        $source      = rtrim(implode('', $source));
        $docBlock    = $reflection->getDocComment();
        if ($docBlock !== false) {
            $source = '    ' . $docBlock . PHP_EOL . $source;
        }
        return $source;
    }
    
    /**
     * Returns the reflection object for the given method.
     *
     * @param string $methodIdentifier
     * @return ReflectionMethod
     * @throws InvalidArgumentException If an invalid identifier is provided.
     */
    protected function toReflectionObject($methodIdentifier)
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
        return $reflection->getMethod($method);
    }
    
}