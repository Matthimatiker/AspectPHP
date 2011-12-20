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
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        AspectPHP_Stream_Wrapper::register();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        AspectPHP_Stream_Wrapper::unregister();
        parent::tearDown();
    }
    
    /**
     * Ensures that isRegistered() returns true if the stream is already registered.
     */
    public function testIsRegisteredReturnsTrueIfStreamIsAlreadyRegistered() {
        $this->assertTrue(AspectPHP_Stream_Wrapper::isRegistered());
    }
    
    /**
     * Ensures that isRegistered() returns false if the stream is not registered.
     */
    public function testIsRegisteredReturnsFalseIfStreamIsNotRegistered() {
        AspectPHP_Stream_Wrapper::unregister();
        $this->assertFalse(AspectPHP_Stream_Wrapper::isRegistered());
    }
    
    /**
     * Checks if register() registers the stream.
     */
    public function testRegisterRegistersStream() {
        
    }
    
    /**
     * Ensures that register() does nothing if the stream is already registered.
     */
    public function testRegisterDoesNothingIfStreamIsAlreadyRegistered() {
        
    }
    
    /**
     * Checks if unregister() removes the registered stream.
     */
    public function testUnregisterRemovesRegisteredStream() {
        
    }
    
    /**
     * Ensures that unregister() does nothing if the stream is not registered.
     */
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
     * Ensures that static methods remain static.
     */
    public function testWrapperDoesNotRemoveStaticAttributeFromMethods() {
        
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