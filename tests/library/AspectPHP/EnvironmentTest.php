<?php

/**
 * AspectPHP_EnvironmentTest
 *
 * @category PHP
 * @package AspectPHP
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 22.04.2013
 */

use Composer\Autoload\ClassLoader;

/**
 * Initializes the test environment.
 */
require_once(dirname(__FILE__) . '/bootstrap.php');

/**
 * Tests the environment intializer.
 *
 * @category PHP
 * @package AspectPHP
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2013 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 22.04.2013
 */
class AspectPHP_EnvironmentTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * System under test.
     *
     * @var AspectPHP_Environment
     */
    protected $environment = null;
    
    /**
     * Class loader that is used for testing.
     *
     * @var \Composer\Autoload\ClassLoader
     */
    protected $loader = null;
    
    /**
     * See {@link PHPUnit_Framework_TestCase::setUp()} for details.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->loader      = $this->createClassLoader();
        $this->environment = new AspectPHP_Environment();
    }
    
    /**
     * See {@link PHPUnit_Framework_TestCase::tearDown()} for details.
     */
    protected function tearDown()
    {
        $this->environment = null;
        $this->loader      = null;
        parent::tearDown();
    }
    
    /**
     * Checks if prepareClassLoader() adds the AspectPHP protocol to namespace paths.
     */
    public function testPrepareClassLoaderAddsProtocolToNamespacePaths()
    {
        $this->environment->prepareClassLoader($this->loader);
        
        $namespacePaths = $this->loader->getPrefixes();
        $this->assertArrayHasKey('AspectPHP', $namespacePaths);
        $paths = $namespacePaths['AspectPHP'];
        $path  = current($paths);
        $this->assertStringStartsWith(AspectPHP_Stream::NAME . '://', $path);
    }
    
    /**
     * Ensures that prepareClassLoader() does not change the number of namespace paths.
     */
    public function testPrepareClassLoaderDoesNotChangeNumberOfRegisteredNamespacePaths()
    {
        $namespacePaths         = $this->loader->getPrefixes();
        $numberOfNamespaces     = count($namespacePaths);
        $numberOfAspectPhpPaths = count($namespacePaths['AspectPHP']);
        
        $this->environment->prepareClassLoader($this->loader);
        
        $namespacePaths = $this->loader->getPrefixes();
        $this->assertCount($numberOfNamespaces, $namespacePaths);
        $this->assertArrayHasKey('AspectPHP', $namespacePaths);
        $this->assertCount($numberOfAspectPhpPaths, $namespacePaths['AspectPHP']);
    }
    
    /**
     * Checks if prepareClassLoader() adds the AspectPHP protocol to file paths
     * in the class map.
     */
    public function testPrepareClassLoaderAddsProtocolToClassMapPaths()
    {
        $this->environment->prepareClassLoader($this->loader);
        $map  = $this->loader->getClassMap();
        $path = current($map);
        $this->assertStringStartsWith(AspectPHP_Stream::NAME . '://', $path);
    }
    
    /**
     * Ensures that prepareClassLoader() does not change the number of paths
     * in the class map.
     */
    public function testPrepareClassLoaderAddsDoesNotChangeSizeOfClassMap()
    {
        $numberOfClasses = count($this->loader->getClassMap());
        
        $this->environment->prepareClassLoader($this->loader);
        
        $this->assertCount($numberOfClasses, $this->loader->getClassMap());
    }
    
    /**
     * Creates a pre-configured class loader for testing.
     *
     * @return \Composer\Autoload\ClassLoader
     */
    protected function createClassLoader()
    {
        $loader = new ClassLoader();
        $loader->set('AspectPHP', array(dirname(__FILE__)));
        $loader->addClassMap(array(__CLASS__ => __FILE__));
        return $loader;
    }
    
    
}
