<?php

/**
 * StreamCheck_FileConstant
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 03.01.2012
 */

/**
 * This class is used to check if the __FILE__ constant is correct.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @version $Rev$
 * @since 03.01.2012
 */
class StreamCheck_FileConstant {
    
    /**
     * Returns the __FILE__ constant.
     *
     * @return string
     */
    public function getFileConstant() {
        return __FILE__;
    }
    
}

?>