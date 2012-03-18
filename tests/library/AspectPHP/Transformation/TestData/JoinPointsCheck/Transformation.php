<?php

/**
 * JoinPointsCheck_Transformation
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 07.01.2012
 */

/**
 * Class that will be transformed.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @since 07.01.2012
 */
final class JoinPointsCheck_Transformation {
    
    /**
     * A static method.
     */
    public static function myStaticMethod() {
        return 'static';
    }
    
    /**
     * Returns the line number.
     *
     * @return integer
     */
    public function getLineNumber() {
        return __LINE__;
    }
    
    /**
     * Returns the instance ($this).
     *
     * @return JoinPointsCheck_Transformation
     */
    public function getContext() {
        return $this;
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
    public function getFunction() {
        return __FUNCTION__;
    }
    
    /**
     * A public method.
     */
    public function myPublicMethod() {
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
    
    /**
     * Method with a doc block that contains some info.
     *
     * @param string $arg
     * @return string
     * @since 07.01.2012
     */
    public function myDocBlockMethod($arg) {
    }
    
    /**
     * Method that returns the received parameters.
     *
     * @param integer $first
     * @param integer $second
     * @return array(integer)
     */
    public function parameters($first, $second) {
        return array($first, $second);
    }
    
    /**
     * Returns all received parameters.
     *
     * @return array(mixed)
     */
    public function variableParameters() {
        return func_get_args();
    }
    
    /**
     * A method with default parameter.
     *
     * @param string $param
     * @return string The received parameter value.
     */
    public function defaultParameter($param = 'Demo') {
        return $param;
    }
    
}

?>