<?php

/**
 * JoinPointsCheck_Transformation
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 07.01.2012
 */

/**
 * Class that will be transformed.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 07.01.2012
 */
class JoinPointsCheck_Transformation {
    
    /**
     * A static method.
     */
    public static function myStaticMethod() {
    }
    
    /**
     * Returns the line number.
     *
     * @return integer
     */
    public function lineNumber() {
        return __LINE__;
    }
    
    /**
     * Returns the instance ($this).
     *
     * @return JoinPointsCheck_Transformation
     */
    public function getContext() {
        $this;
    }
    
    /**
     * Throws an exception.
     *
     * @throws RuntimeException Will always be thrown.
     */
    public function throwException() {
        throw new RuntimeException('Test exception');
    }
    
    /**
     * Triggers a notice.
     */
    public function triggerNotice() {
        trigger_error('Test notice.', E_USER_NOTICE);
    }
    
    /**
     * Returns the magic __CLASS__ constant.
     */
    public function getClass() {
        return __CLASS__;
    }
    
    /**
     * Returns the magic __METHOD__ constant.
     */
    public function getMethod() {
        return __METHOD__;
    }
    
    /**
     * Returns the magic __FUNCTION__ constant.
     */
    public function getFuncction() {
        return __FUNCTION__;
    }
    
    /**
     * A protected method.
     */
    protected function myProtectedMethod() {
    }
    
    /**
     * A private method.
     */
    private function myPrivateMethod() {
    }
    
    /**
     * A final method.
     */
    public final function myFinalMethod() {
    }
    
}