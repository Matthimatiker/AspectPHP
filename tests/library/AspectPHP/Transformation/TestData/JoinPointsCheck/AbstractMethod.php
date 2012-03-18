<?php

/**
 * JoinPointsCheck_AbstractMethod
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 31.01.2012
 */

/**
 * This class contains an abstract method.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 31.01.2012
 */
abstract class JoinPointsCheck_AbstractMethod {
    
    /**
     * This is an abstract method...
     */
    abstract function myAbstractMethod();
    
    /**
     * ... followed by a concrete method.
     */
    public function myMethod() {
        return 'Hello World!';
    }
    
}

?>