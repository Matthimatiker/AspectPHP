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
     * The original include path.
     *
     * @var string
     */
    private $previousIncludePath = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp() {
        parent::setUp();
        $this->storeIncludePath();
        AspectPHP_Stream_Wrapper::register();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown() {
        AspectPHP_Stream_Wrapper::unregister();
        $this->restoreIncludePath();
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
        $path = $this->toStream($this->getPath('Stream/IoCheck.php'));
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
    public function testStatProvidesRequiredMetaData() {
        $path = $this->toStream($this->getPath('Stream/IoCheck.php'));
        $data = stat($stat);
        $this->assertInternalType('array', $data);
        // Check the required numerical and associative keys.
        $this->assertArrayHasKey(0, $data);
        $this->assertArrayHasKey('dev', $data);
        $this->assertArrayHasKey(1, $data);
        $this->assertArrayHasKey('ino', $data);
        $this->assertArrayHasKey(2, $data);
        $this->assertArrayHasKey('mode', $data);
        $this->assertArrayHasKey(3, $data);
        $this->assertArrayHasKey('nlink', $data);
        $this->assertArrayHasKey(4, $data);
        $this->assertArrayHasKey('uid', $data);
        $this->assertArrayHasKey(5, $data);
        $this->assertArrayHasKey('gid', $data);
        $this->assertArrayHasKey(6, $data);
        $this->assertArrayHasKey('rdev', $data);
        $this->assertArrayHasKey(7, $data);
        $this->assertArrayHasKey('size', $data);
        $this->assertArrayHasKey(8, $data);
        $this->assertArrayHasKey('atime', $data);
        $this->assertArrayHasKey(9, $data);
        $this->assertArrayHasKey('mtime', $data);
        $this->assertArrayHasKey(10, $data);
        $this->assertArrayHasKey('ctime', $data);
        $this->assertArrayHasKey(11, $data);
        $this->assertArrayHasKey('blksize', $data);
        $this->assertArrayHasKey(12, $data);
        $this->assertArrayHasKey('blocks', $data);
    }
    
    /**
     * Ensures that is_writable() returns always false.
     */
    public function testIsWritableReturnsFalse() {
        $path = $this->toStream($this->getPath('Stream/IoCheck.php'));
        $this->assertFalse(is_writable($path));
    }
    
    /**
     * Ensures that the wrapper cannot be used to modify files.
     */
    public function testWrapperDoesNotAllowModifyingFiles() {
        $path = $this->getPath('WriteTest.txt');
        // Ensures that the test file is empty.
        file_put_contents($path, '');
        // Suppress notices, otherwise PHPUnit would convert them to exceptions
        // and stop test execution.
        @file_put_contents($this->toStream($path), 'This should not be added.');
        $this->assertEquals(0, filesize($path), 'File was modified.');
    }
    
    /**
     * Checks if the wrapper modifies the loaded code.
     */
    public function testWrapperModifiesLoadedCode() {
        $path       = $this->getPath('Stream/IoCheck.php');
        $original   = file_get_contents($path);
        $fromStream = file_get_contents($this->toStream($path));
        $this->assertNotEquals($original, $fromStream);
    }
    
    /**
     * Checks if the wrapper generates valid PHP code.
     */
    public function testWrapperGeneratesValidCode() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Ensures that the wrapper can be used to load a file via include()
     * if the full file path is passed.
     */
    public function testWrapperCanBeUsedToIncludeFileByFullPath() {
        $path = $this->getPath('Stream/IncludeCheck/FullPath.php');
        include($this->toStream($path));
        $this->assertClassExists('Stream_IncludeCheck_FullPath');
    }
    
    /**
     * Ensures that the wrapper can be used to load files via include()
     * by using the include path.
     */
    public function testWrapperCanBeUsedToIncludeFileFromIncludePath() {
        $this->changeIncludePath();
        include('Stream/IncludeCheck/RelativePath.php');
        $this->assertClassExists('Stream_IncludeCheck_RelativePath');
    }
    
    /**
     * Ensures that the wrapper does not change the original method names.
     */
    public function testWrapperDoesNotChangeOriginalMethodNames() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Ensures that the wrapper does not modify the visibility of the original
     * methods.
     */
    public function testWrapperDoesNotChangeMethodVisibility() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Ensures that static methods remain static.
     */
    public function testWrapperDoesNotRemoveStaticAttributeFromMethods() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Ensures that the wrapper does not suppress errors if invalid
     * code is loaded.
     */
    public function testWrapperDoesNotSuppressErrors() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Ensures that the wrapper does not modify source code that
     * contains errors.
     */
    public function testWrapperDoesNotModifyCodeWithErrors() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Ensures that the __FILE__ constant works correctly in loaded
     * classes.
     */
    public function testFileConstantIsUsableInLoadedFiles() {
        $path = $this->getPath('Stream/FileConstant.php');
        include($this->toStream($path));
        $this->assertClassExists('Stream_FileConstant');
        $check = new Stream_FileConstant();
        $value = $check->getFileConstant();
        $this->assertEquals(realpath($path), realpath($value));
    }
    
    /**
     * Ensures that the wrapper does not modify files that do not contain classes.
     */
    public function testWrapperDoesNotModifyFilesThatDoNotContainClasses() {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * Enusres that the wrapper does not modify the line numbers of the original code.
     */
    public function testWrapperDoesNotChangeLineNumbers() {
        // Ensure that the test fails if the exception is not thrown.
        $this->setExpectedException('RuntimeException');
        include($this->toStream($this->getPath('Stream/ModificationCheck/LineNumber.php')));
        $this->assertClassExists('Stream_ModificationCheck_LineNumber');
        try {
            $check = new Stream_ModificationCheck_LineNumber();
            $check->lineNumber();
        } catch(RuntimeException $e) {
            $this->assertEquals(12, $e->getLine(), 'Stream changed line numbers.');
            throw $e;
        }
    }
    
    /**
     * Asserts that the class with the provided name was loaded.
     *
     * @param string $class
     */
    protected function assertClassExists($class) {
        $message = 'The class "' . $class . '" was not loaded.';
        $this->assertTrue(class_exists($class, false), $message);
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
        return $this->getTestDataDirectory() . '/' . $testFile;
    }
    
    /**
     * Returns the path to the test data directory.
     *
     * @return string
     */
    protected function getTestDataDirectory() {
        return dirname(__FILE__) . '/TestData';
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
    
    /**
     * Stores the current include path.
     */
    protected function storeIncludePath() {
        $this->previousIncludePath = get_include_path();
    }
    
    /**
     * Restores the include path that was saved by storeIncludePath().
     */
    protected function restoreIncludePath() {
        set_include_path($this->previousIncludePath);
    }
    
    /**
     * Sets the include path to the test data directory and uses the
     * stream to load data from that path.
     */
    protected function changeIncludePath() {
        set_include_path($this->toStream($this->getTestDataDirectory()));
    }
    
}

?>