<?php

/**
 * AspectPHP_Reflection_Pointcut
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
 * Represents a pointcut method.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_Pointcut extends AspectPHP_Reflection_Method
{
    
    /**
     * Creates already created pointcut objects.
     *
     * The object identifier of the aspect is used as key.
     *
     * @var array(string=>AspectPHP_Pointcut)
     */
    protected $pointcutsByAspect = array();
    
    /**
     * Creates a pointcut reflection object.
     *
     * @param AspectPHP_Reflection_Aspect|AspectPHP_Aspect|string $aspect
     * @param string $name
     * @throws AspectPHP_Reflection_Exception If the method is not a valid pointcut.
     */
    public function __construct($aspect, $name)
    {
        parent::__construct($aspect, $name);
        $this->assertIsPointcut();
    }
    
    /**
     * Creates a pointcut object for the given aspect.
     *
     * The pointcut object is created only once per aspect object.
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Pointcut
     * @throws AspectPHP_Reflection_Exception If the method does not return pointcut.
     */
    public function createPointcut(AspectPHP_Aspect $aspect)
    {
        $id = $this->id($aspect);
        if (!isset($this->pointcutsByAspect[$id])) {
            $pointcut = $this->invoke($aspect, array());
            if (!($pointcut instanceof AspectPHP_Pointcut)) {
                $message = 'Pointcut %s() in aspect %s must return an instance of AspectPHP_Pointcut.';
                throw new AspectPHP_Reflection_Exception($this->message($message));
            }
            $this->pointcutsByAspect[$id] = $pointcut;
        }
        return $this->pointcutsByAspect[$id];
    }
    
    /**
     * Asserts that this method meets the pointcut requirements.
     *
     * @throws AspectPHP_Reflection_Exception If the method is not a valid pointcut.
     */
    protected function assertIsPointcut()
    {
        if (!$this->isPublic()) {
            $message = 'Pointcut %s() in aspect %s must be public.';
            throw new AspectPHP_Reflection_Exception($this->message($message));
        }
        if ($this->getNumberOfRequiredParameters() > 0) {
            $message = 'Pointcut %s() in aspect %s must not require any parameter.';
            throw new AspectPHP_Reflection_Exception($this->message($message));
        }
    }
    
    /**
     * Creates an id for the given aspect object,
     *
     * @param AspectPHP_Aspect $aspect
     * @return string
     */
    protected function id(AspectPHP_Aspect $aspect)
    {
        return spl_object_hash($aspect);
    }
    
}