<?php

/**
 * AspectPHP_Environment
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 12.01.2012
 */

use Composer\Autoload\ClassLoader;

/**
 * Helper class that is able to configure the AspectPHP environment.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 12.01.2012
 */
class AspectPHP_Environment
{
    
    /**
     * The aspect manager.
     *
     * @var AspectPHP_Manager
     */
    protected $manager = null;
    
    /**
     * Returns the aspect manager that will be used.
     *
     * @return AspectPHP_Manager
     */
    public function getManager()
    {
        if ($this->manager === null) {
            $this->manager = new AspectPHP_Manager_Standard();
        }
        return $this->manager;
    }
    
    /**
     * Activates AspectPHP.
     *
     * Returns the manager that can be used to register aspects.
     *
     * @return AspectPHP_Manager
     */
    public function initialize()
    {
        $this->registerStream();
        $this->exposeManager();
        $this->prepareIncludePath();
    }
    
    /**
     * Pepares the class loader to ensure that it loads
     * weaved classes.
     *
     * @param Composer\Autoload\ClassLoader $loader
     */
    public function prepareClassLoader($loader)
    {
        $pathsByNamespace = $loader->getPrefixes();
        foreach ($pathsByNamespace as $namespace => $paths) {
            /* @var $namspace string */
            /* @var $paths array(string) */
            $loader->set($namespace, array_map($this->getSchemeCallback(), $paths));
        }
        $map = array_map($this->getSchemeCallback(), $loader->getClassMap());
        $loader->addClassMap($map);
    }
    
    /**
     * Modifies the include path and ensures that the classes
     * are loaded with the AspectPHP stream.
     */
    public function prepareIncludePath()
    {
        $paths = explode(PATH_SEPARATOR, get_include_path());
        $paths = array_map($this->getSchemeCallback(), $paths);
        set_include_path(implode(PATH_SEPARATOR, $paths));
    }
    
    /**
     * Registers the AspectPHP stream.
     */
    public function registerStream()
    {
        AspectPHP_Stream::register();
        
    }
    
    /**
     * Exposes the manager and ensures that it is available globally.
     */
    public function exposeManager()
    {
        AspectPHP_Container::setManager($this->getManager());
    }
    
    /**
     * Returns a callback that is used to add the AspectPHP stream scheme to paths.
     *
     * @return callback
     */
    protected function getSchemeCallback()
    {
        return array('AspectPHP_Stream', 'addSchemeToPath');
    }
    
}