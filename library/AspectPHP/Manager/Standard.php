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
     * Contains advisors of each registered aspect.
     *
     * A string that identifies an aspect object is used as key.
     *
     * @var array(string=>AspectPHP_Advisor_Container)
     */
    protected $advisorsByAspect = array();
    
    /**
     * Helper object that is used to extract advisors from aspects.
     *
     * @var AspectPHP_Advice_Extractor
     */
    protected $extractor = null;
    
    /**
     * Creates and initializes the manager.
     */
    public function __construct()
    {
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
        $this->advisorsByAspect[spl_object_hash($aspect)] = $this->extractAdvisors($aspect);
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
        unset($this->advisorsByAspect[spl_object_hash($aspect)]);
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
     * @return AspectPHP_Advisor_Container
     * @todo Refactoring: move parts of method to container
     * @todo Return just advices, update type in interface
     */
    public function getAdvicesFor($method)
    {
        $container = new AspectPHP_Advisor_Container();
        foreach ($this->advisorsByAspect as $advisors) {
            /* @var $advisors AspectPHP_Advisor_Container */
            foreach (AspectPHP_Advice_Type::all() as $type) {
                /* @var $type string */
                foreach ($advisors->{$type}() as $advisor) {
                    /* @var $advisor AspectPHP_Advisor */
                    if ($advisor->getPointcut()->matches($method)) {
                        $container->{$type}()->add($advisor);
                    }
                }
            }
        }
        return $container;
    }
    
    /**
     * Extracts all advisors from the given aspect.
     *
     * @param AspectPHP_Aspect $aspect
     * @return AspectPHP_Advisor_Container
     */
    protected function extractAdvisors(AspectPHP_Aspect $aspect)
    {
        return $this->extractor->getAdvicesFrom($aspect);
    }
    
}