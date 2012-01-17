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
     * Creates the transformation class.
     *
     * The given map specifies the replacement rules.
     * The token type (for example T_WHITESPACE) is used as key,
     * the replacement as value.
     *
     * @param array(integer=>string) $map
     */
    public function __construct(array $map) {
        
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