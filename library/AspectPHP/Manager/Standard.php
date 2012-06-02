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
     * @var array(AspectPHP_Aspect)
     */
    protected $aspects = array();
    
    /**
     * Contains the advices of each registered aspect.
     *
     * A string that identifies an aspect object is used as key.
     *
     * @var array(string=>AspectPHP_Advisor_Container)
     */
    protected $advicesByAspect = array();
    
    /**
     * Helper object that is used to extract advices from aspects.
     *
     * @var AspectPHP_Advice_Extractor
     */
    protected $extractor = null;
    
    /**
     * Creates and initializes the manager.
     */
    public function __construct()
    {
        $this->advices   = new AspectPHP_Advice_Container();
        $this->extractor = new AspectPHP_Advice_Extractor();
    }
    
    /**
     * See {@link AspectPHP_Manager::register()} for details.
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function register(AspectPHP_Aspect $aspect)
    {
        $this->aspects[] = $aspect;
        $this->advicesByAspect[spl_object_hash($aspect)] = $this->extractAdvices($aspect);
    }
    
    /**
     * See {@link AspectPHP_Manager::unregister()} for details.
     *
     * @param AspectPHP_Aspect $aspect
     */
    public function unregister(AspectPHP_Aspect $aspect)
    {
        $index = array_search($aspect, $this->aspects, true);
        if ($index === false) {
            // Aspect not found.
            return;
        }
        unset($this->aspects[$index]);
        unset($this->advicesByAspect[spl_object_hash($aspect)]);
    }
    
    /**
     * See {@link AspectPHP_Manager::getAspects()} for details.
     *
     * @return array(AspectPHP_Aspect)
     */
    public function getAspects()
    {
        return $this->aspects;
    }
    
    /**
     * See {@link AspectPHP_Manager::getAdvicesFor()} for details.
     *
     * @param string $method
     * @return AspectPHP_Advice_Container
     * @todo Refactoring: move parts of method to container
     */
    public function getAdvicesFor($method)
    {
        $container = new AspectPHP_Advice_Container();
        foreach ($this->advicesByAspect as $advices) {
            /* @var $advices AspectPHP_Advice_Container */
            foreach (AspectPHP_Advice_Type::all() as $type) {
                /* @var $type string */
                foreach ($advices->{$type}() as $advice) {
                    /* @var $advice AspectPHP_Advice */
                    if ($advice->getPointcut()->matches($method)) {
                        $container->{$type}()->add($advice);
                    }
                }
            }
        }
        return $container;
    }
    
    /**
     * Extracts all advices from the given aspect.
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Advice_Container
     */
    protected function extractAdvices(AspectPHP_Aspect $aspect)
    {
        return $this->extractor->getAdvicesFrom($aspect);
    }
    
}