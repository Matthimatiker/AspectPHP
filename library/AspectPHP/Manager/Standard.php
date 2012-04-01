<?php

/**
 * AspectPHP_Manager_Standard
 *
 * @category PHP
 * @package AspectPHP_Manager
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 12.01.2012
 */

/**
 * The default manager that stores registered aspects in memory.
 *
 * Registrations are lost if the manager object is destroyed.
 *
 * @category PHP
 * @package AspectPHP_Manager
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 12.01.2012
 */
class AspectPHP_Manager_Standard implements AspectPHP_Manager
{
    
    /**
     * The registered aspects.
     *
     * The pointcut is used as key, the aspect objects as value.
     *
     * @var array(string=>array(AspectPHP_Aspect))
     */
    protected $aspects = array();
    
    /**
     * See {@link AspectPHP_Manager::register()} for details.
     *
     * @param AspectPHP_Aspect $aspect
     * @param string $pointcut
     */
    public function register(AspectPHP_Aspect $aspect, $pointcut = null)
    {
        if (!isset($this->aspects[$pointcut])) {
            $this->aspects[$pointcut] = array();
        }
        $this->aspects[$pointcut][] = $aspect;
    }
    
    /**
     * See {@link AspectPHP_Manager::unregister()} for details.
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function unregister(AspectPHP_Aspect $aspect)
    {
        foreach ($this->aspects as $pointcut => $aspects) {
            /* @var string $pointcut */
            /* @var array(AspectPHP_Aspect) $aspects */
            foreach ($aspects as $index => $currentAspect) {
                /* @var AspectPHP_Aspect $currentAspect */
                if ($currentAspect === $aspect) {
                    unset($this->aspects[$pointcut][$index]);
                }
            }
        }
    }
    
    /**
     * See {@link AspectPHP_Manager::getAspects()} for details.
     *
     * @return array(AspectPHP_Aspect)
     */
    public function getAspects()
    {
        $allAspects = array();
        foreach ($this->aspects as $aspects) {
            $allAspects = array_merge($allAspects, $aspects);
        }
        return $allAspects;
    }
    
    /**
     * Returns the aspects that were registered for the given method.
     *
     * @param string $method
     * @return array(AspectPHP_Aspect)
     * @deprecated Will not be used in the future. See getAdvicesFor().
     */
    public function getAspectsFor($method)
    {
        if (!isset($this->aspects[$method])) {
            return array();
        }
        return $this->aspects[$method];
    }
    
    /**
     * See {@link AspectPHP_Manager::getAdvicesFor()} for details.
     *
     * @param string $method
     * @return AspectPHP_Advice_Container
     */
    public function getAdvicesFor($method)
    {
        
    }
    
}