<?php

class StreamCheck_Modification_LineNumber {
    
    /**
     * Throws an exception that will be used to check the line number.
     *
     * @throws RuntimeException To check the line number.
     */
    public function lineNumber()
    {
        throw new RuntimeException('This exception was thrown in line 12.');
    }
    
}

?>