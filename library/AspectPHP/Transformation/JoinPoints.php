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
     * The tokens of the source code that is currently processed.
     *
     * @var array(array(integer=>string|integer)|string)
     */
    protected $tokens = array();
    
    /**
     * Transforms the source code.
     *
     * @param string $source
     * @return string The transformed code.
     */
    public function transform($source) {
        // TODO: extract token analyzer class
        $this->tokens = token_get_all($source);
        foreach( $this->tokens as $token ) {
            /* @var array(integer=>string|integer)|string */
            if( $token[0] === T_FUNCTION ) {
                
            }
        }
        return $source;
    }
    
}

?>