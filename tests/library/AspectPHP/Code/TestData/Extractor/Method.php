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
     */
    public function withDocBlock()
    {
        $a = 42 - 7;
        return $a;
    }
    
    public function withoutDocBlock()
    {
        // A method without doc block.
    }
    
}