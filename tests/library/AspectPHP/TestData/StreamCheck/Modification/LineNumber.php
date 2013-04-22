<?php

/**
 * StreamCheck_Modification_LineNumber
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 04.01.2012
 */

/**
 * File that is used to check if the stream keeps the original line numbers.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 04.01.2012
 */
class StreamCheck_Modification_LineNumber {
    
    /**
     * Throws an exception that will be used to check the line number.
     *
     * @throws RuntimeException To check the line number.
     */
    public function lineNumber()
    {
        throw new RuntimeException('This exception was thrown in line 27.');
    }
    
}

?>