<?php

/**
 * AspectPHP_Transformation_Replace
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 17.01.2012
 */

/**
 * Transformation class that replaces specific tokens by provided values.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 17.01.2012
 */
class AspectPHP_Transformation_Replace {
    
    /**
     * Specifies the replacement rules.
     *
     * The given map contains the replacement rules.
     * The token type (for example T_WHITESPACE) is used as key,
     * the replacement as value.
     *
     * Example:
     * <code>
     * $transformation->setRules(array(T_WHITESPACE => ''));
     * </code>
     *
     * @param array(integer=>string) $map
     */
    public function setRules(array $map) {
        
    }
    
    /**
     * Transforms the provided source code.
     *
     * @param string $source
     * @return string
     */
    public function transform($source) {
        
    }
    
}

?>