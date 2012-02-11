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
     * @param string $method The method identifier.
     * @return string The extracted source code.
     * @throws InvalidArgumentException If the method does not exist.
     */
    public function getSource($method) {
        
    }
    
}

?>