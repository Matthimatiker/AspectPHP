<?php

/**
 * AspectPHP_Manager_Standard
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Manager
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 12.01.2012
 */

/**
 * The default manager that stores registered aspects in memory.
 *
 * Registrations are lost if the manager object is destroyed.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP_Manager
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 12.01.2012
 */
class AspectPHP_Manager_Standard implements AspectPHP_Manager {
    
    /**
     * The registered aspects.
     *
     * The pointcut is used as key, the aspect objects as value.
     *
     * @var array(string=>array(AspectPHP_Aspect))
     */
    protected $aspects = array();
    
    /**
     * @see AspectPHP_Manager::register()
     *
     * @param AspectPHP_Aspect $aspect
     * @param string $pointcut
     */
    public function register(AspectPHP_Aspect $aspect, $pointcut) {
        if( !isset($this->aspects[$pointcut]) ) {
            $this->aspects[$pointcut] = array();
        }
        $this->aspects[$pointcut][] = $aspect;
    }
    
    /**
     * @see AspectPHP_Manager::unregister()
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function unregister(AspectPHP_Aspect $aspect) {
        foreach( $this->aspects as $pointcut => $aspects ) {
            /* @var string $pointcut */
            /* @var array(AspectPHP_Aspect) $aspects */
            foreach( $aspects as $index => $currentAspect ) {
            	/* @var AspectPHP_Aspect $currentAspect */
                if( $currentAspect === $aspect ) {
                    unset($this->aspects[$pointcut][$index]);
                }
            }
        }
    }
    
    /**
     * @see AspectPHP_Manager::getAspects()
     *
     * @return array(AspectPHP_Aspect)
     */
    public function getAspects() {
        $allAspects = array();
        foreach( $this->aspects as $aspects ) {
            $allAspects = array_merge($allAspects, $aspects);
        }
        return $allAspects;
    }
    
    /**
     * @see AspectPHP_Manager::getMatchingAspects()
     *
     * @param string $method
     * @return array(AspectPHP_Aspect)
     */
    public function getAspectsFor($method) {
        if( !isset($this->aspects[$method]) ) {
            return array();
        }
        return $this->aspects[$method];
    }
    
}

?>