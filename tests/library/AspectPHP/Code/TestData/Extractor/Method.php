<?php

/**
 * Extractor_Method
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 13.03.2012
 */

/**
 * Class that is used to test the code extractor.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 13.03.2012
 */
class Extractor_Method
{
    
    /**
     * A method with doc block.
     *
     * @param integer $value
     * @return integer
     */
    public function withDocBlock($value = 7)
    {
        $a = 42 - $value;
        return $a;
    }
    
    public function withoutDocBlock()
    {
        // A method without doc block.
    }
    
}