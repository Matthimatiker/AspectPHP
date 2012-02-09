<?php

/**
 * AspectPHP_Pointcut_RegExpTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the regular expression pointcut.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Pointcut
 * @subpackage Tests
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 09.02.2012
 */
class AspectPHP_Pointcut_RegExpTest extends PHPUnit_Framework_TestCase {
    
    public function testConstructorThrowsExceptionIfEmptyStringIsProvided() {
        
    }
    
    public function testConstructorThrowsExceptionIfNoStringIsProvided() {
        
    }
    
    public function testMatchesReturnsBoolean() {
        
    }
    
    public function testMatchesReturnsTrueIfExpressionMatchesMethod() {
        
    }
    
    public function testMatchesReturnsFalseIfExpressionDoesNotMatchMethod() {
        
    }
    
    public function testMatchesReturnsTrueIfExpressionMatchesNamespacedClass() {
        
    }
    
    public function testMatchesReturnsTrueIfExpressionDoesNotMatchNamespacedClass() {
        
    }
    
    /**
     * Uses the given expression to create a pointcut.
     *
     * @param string $expression
     * @return AspectPHP_Pointcut_RegExp
     */
    protected function create($expression) {
        
    }
    
}

?>