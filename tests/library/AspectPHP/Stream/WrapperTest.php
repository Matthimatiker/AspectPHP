<?php

/**
 * AspectPHP_Stream_WrapperTest
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Stream
 * @subpackage Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the AspectPHP stream wrapper.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Stream
 * @subpackage Tests
 * @copyright Matthias Molitor 2011
 * @version $Rev$
 * @since 13.12.2011
 */
class AspectPHP_Stream_WrapperTest extends PHPUnit_Framework_TestCase {
    
    public function testIsRegisteredReturnsTrueIfStreamIsAlreadyRegistered() {
        
    }
    
    public function testIsRegisteredReturnsFalseIfStreamIsNotRegistered() {
        
    }
    
    public function testRegisterRegistersStream() {
        
    }
    
    public function testRegisterDoesNothingIfStreamIsAlreadyRegistered() {
        
    }
    
    public function testUnregisterRemovesRegisteredStream() {
        
    }
    
    public function testUnregisterDoesNothingIfStreamIsNotRegistered() {
        
    }
    
    /**
     * Ensures that is_file() returns true if the given path points
     * to a existing file.
     */
    public function testIsFileReturnsTrueIfFileExists() {
        
    }
    
    /**
     * Ensures that is_file() returns false if the given path points
     * to a not existing file.
     */
    public function testIsFileReturnsFalseIfFileDoesNotExist() {
        
    }
    
    /**
     * Checks if stat() returns valid data about the given file.
     */
    public function testStatReturnsCorrectFileData() {
        
    }
    
    /**
     * Ensures that is_writable() returns always false.
     */
    public function testIsWritableReturnsFalse() {
        
    }
    
    /**
     * Ensures that the wrapper cannot be used to modify files.
     */
    public function testWrapperDoesNotAllowModifyingFiles() {
        
    }
    
    /**
     * Checks if the wrapper modifies the loaded code.
     */
    public function testWrapperModifiesLoadedCode() {
        
    }
    
    /**
     * Checks if the wrapper generates valid PHP code.
     */
    public function testWrapperGeneratesValidCode() {
        
    }
    
    /**
     * Ensures that the wrapper can be used to load a file via include()
     * if the full file path is passed.
     */
    public function testWrapperCanBeUsedToIncludeFileByFullPath() {
        
    }
    
    /**
     * Ensures that the wrapper can be used to load files via include()
     * by using the include path.
     */
    public function testWrapperCanBeUsedToIncludeFileFromIncludePath() {
        
    }
    
    /**
     * Ensures that the wrapper does not change the original method names.
     */
    public function testWrapperDoesNotChangeOriginalMethodNames() {
        
    }
    
    /**
     * Ensures that the wrapper does not modify the visibility of the original
     * methods.
     */
    public function testWrapperDoesNotChangeMethodVisibility() {
        
    }
    
    /**
     * Ensures that the wrapper does not suppress errors if invalid
     * code is loaded.
     */
    public function testWrapperDoesNotSuppressErrors() {
        
    }
    
    /**
     * Ensures that the wrapper does not modify source code that
     * contains errors.
     */
    public function testWrapperDoesNotModifyCodeWithErrors() {
        
    }
    
    /**
     * Ensures that the __FILE__ constant works correctly in loaded
     * classes.
     */
    public function testFileConstantIsUsableInLoadedFiles() {
        
    }
    
    /**
     * Ensures that the wrapper does not modify files that do not contain classes.
     */
    public function testWrapperDoesNotModifyFilesThatDoNotContainClasses() {
        
    }
    
}

?>