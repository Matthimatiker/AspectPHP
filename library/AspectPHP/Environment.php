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
     * Pepares the class loader to ensure that it loads
     * weaved classes.
     *
     * @param Composer\Autoload\ClassLoader $loader
     */
    public function prepareClassLoader($loader)
    {
        
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
        AspectPHP_Stream::register();
        AspectPHP_Container::setManager($this->getManager());
        $this->modifyIncludePath();
    }
    
    /**
     * Modifies the include path and ensures that the classes
     * are loaded with the AspectPHP stream.
     */
    protected function modifyIncludePath()
    {
        $paths         = explode(PATH_SEPARATOR, get_include_path());
        $numberOfPaths = count($paths);
        for ($i = 0; $i < $numberOfPaths; $i++) {
            $paths[$i] = $this->toStream($paths[$i]);
        }
        set_include_path(implode(PATH_SEPARATOR, $paths));
    }
    
    /**
     * Adds the AspectPHP stream scheme to the given path.
     *
     * @param string $path
     * @return string
     */
    protected function toStream($path)
    {
        return AspectPHP_Stream::NAME . '://' . $path;
    }
    
}