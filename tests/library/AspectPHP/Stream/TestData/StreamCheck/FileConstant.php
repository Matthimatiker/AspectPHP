<?php

/**
 * This class is used to check if the __FILE__ constant is correct.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 03.01.2012
 */
class Stream_FileConstant {
    
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