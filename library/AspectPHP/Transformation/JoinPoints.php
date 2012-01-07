<?php

/**
 * AspectPHP_Transformation_JoinPoints
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */

/**
 * Transformation class that adds injection points to the given source code.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Transformation
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 05.01.2012
 */
class AspectPHP_Transformation_JoinPoints {
    
    /**
     * Transforms the source code.
     *
     * @param string $source
     * @return string The transformed code.
     */
    public function transform($source) {
        return $source;
    }
    
}

?>