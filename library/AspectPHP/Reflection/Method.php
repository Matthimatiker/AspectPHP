<?php

/**
 * AspectPHP_Reflection_Method
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */

/**
 * Class for methods that belong to an aspect.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_Method extends ReflectionMethod
{
    
    /**
     * The aspect that contains the method.
     *
     * @var AspectPHP_Reflection_Aspect
     */
    protected $aspect = null;
    
    /**
     * Creates a method reflection object.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @param string $name
     */
    public function __construct($aspect, $name)
    {
        $this->aspect = $this->toReflection($aspect);
        parent::__construct($this->aspect->getName(), $name);
    }
    
    /**
     * Returns information about the aspect that declares this method.
     *
     * @return AspectPHP_Reflection_Aspect
     */
    public function getAspect()
    {
        return $this->aspect;
    }
    
    /**
     * Adds infos to the given message.
     *
     * Adds the following parameters (in this order):
     * # method name
     * # aspect name
     *
     * Example:
     * <code>
     * $message = $this->message('Method %s in aspect %s.');
     * </code>
     *
     * @param string $message
     * @return string
     */
    protected function message($message)
    {
        return sprintf($message, $this->getName(), $this->aspect->getName());
    }
    
    /**
     * Returns a reflection object for the provided aspect.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @return AspectPHP_Reflection_Aspect
     * @throws AspectPHP_Reflection_Exception If invalid aspect data is provided.
     */
    protected function toReflection($aspect)
    {
        if ($aspect instanceof AspectPHP_Reflection_Aspect) {
            // Use existing reflection object.
            return $aspect;
        }
        return new AspectPHP_Reflection_Aspect($aspect);
    }
    
}