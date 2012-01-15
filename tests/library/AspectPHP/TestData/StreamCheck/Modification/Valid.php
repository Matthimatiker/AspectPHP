<?php

/**
 * StreamCheck_Modification_Valid
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 04.01.2012
 */

/**
 * Class that is used to check if the stream creates valid code.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 04.01.2012
 */
class StreamCheck_Modification_Valid {
    
    /**
     * A static vairable.
     *
     * @var integer
     */
    protected static $myStaticVar = 0;
    
    /**
     * A simple attribute.
     *
     * @var integer
     */
    protected $myVar = 42;
    
    /**
     * Static method dummy.
     */
    public static function myStaticMethod() {
        return self::$myStaticVar;
    }
    
    /**
     * Method dummy.
     */
    protected function myMethod() {
        return $this->myVar;
    }
    
}