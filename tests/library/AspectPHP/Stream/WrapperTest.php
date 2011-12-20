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
        $streams = stream_get_wrappers();
        $this->assertContains(AspectPHP_Stream_Wrapper::NAME, $streams);
    }
    
    /**
     * Ensures that register() does nothing if the stream is already registered.
     */
    public function testRegisterDoesNothingIfStreamIsAlreadyRegistered() {
        $this->setExpectedException(null);
        AspectPHP_Stream_Wrapper::register();
    }
    
    /**
     * Checks if unregister() removes the registered stream.
     */
    public function testUnregisterRemovesRegisteredStream() {
        AspectPHP_Stream_Wrapper::unregister();
        $streams = stream_get_wrappers();
        $this->assertNotContains(AspectPHP_Stream_Wrapper::NAME, $streams);
    }
    
    /**
     * Ensures that unregister() does nothing if the stream is not registered.
     */
    public function testUnregisterDoesNothingIfStreamIsNotRegistered() {
        $this->setExpectedException(null);
        AspectPHP_Stream_Wrapper::unregister();
        AspectPHP_Stream_Wrapper::unregister();
    }
    
    /**
     * Ensures that is_file() returns true if the given path points
     * to a existing file.
     */
    public function testIsFileReturnsTrueIfFileExists() {
        $path = $this->toStream($this->getPath('Check.php'));
        $this->assertTrue(is_file($path));
    }
    
    /**
     * Ensures that is_file() returns false if the given path points
     * to a not existing file.
     */
    public function testIsFileReturnsFalseIfFileDoesNotExist() {
        $path = $this->toStream($this->getPath('Missing.php'));
        $this->assertFalse(is_file($path));
    }
    
    /**
     * Checks if stat() returns valid data about the given file.
     */
    public function testStatReturnsCorrectFileData() {
        $this->markTestIncomplete('Not implemented yet.');
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
    
    /**
     * Returns the path to the test file with the given name.
     *
     * Example:
     * <code>
     * $path = $this->getPath('test.php');
     * </code>
     *
     * Test files are located in the TestData directory.
     * The method does not check if the requested file exists.
     *
     * @param string $testFile
     * @return string
     */
    protected function getPath($testFile) {
        return dirname(__FILE__) . '/TestData/' . $testFile;
    }
    
    /**
     * Adds the stream identifier to the given path.
     *
     * Example:
     * <code>
     * // Returns "aspectphp://path/to/file".
     * $path = $this->toStream('path/to/file');
     * </code>
     *
     * @param string $path
     * @return string
     */
    protected function toStream($path) {
        return AspectPHP_Stream_Wrapper::NAME . '://' . $path;
    }
    
}

?>