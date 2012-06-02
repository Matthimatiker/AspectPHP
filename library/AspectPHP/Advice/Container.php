<?php

/**
 * AspectPHP_Advice_Container
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.03.2012
 */

/**
 * Container class that holds an arbitrary number of advices grouped by type.
 *
 * The container provides a composite object for each advice type. An arbitrary
 * number of advices may be added for each type:
 * <code>
 * $container = new AspectPHP_Advice_Container();
 * $container->before()->add($myAdvice);
 * </code>
 *
 * @category PHP
 * @package AspectPHP_Advice
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.03.2012
 */
class AspectPHP_Advice_Container implements Countable
{
    
    /**
     * Contains a composite object for each advice type.
     *
     * The composites contain the added advices.
     * The name of the advice type (for example "before")
     * is used as key.
     *
     * @var array(string=>AspectPHP_Advisor_Composite)
     */
    protected $advicesByType = array();
    
    /**
     * Creates the container.
     */
    public function __construct()
    {
        // Initialize the composite objects.
        foreach (AspectPHP_Advice_Type::all() as $type) {
            /* @var $type string */
            $this->advicesByType[$type] = new AspectPHP_Advisor_Composite();
        }
    }
    
    /**
     * Returns a composite that holds the before advices.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function before()
    {
        return $this->advicesByType[AspectPHP_Advice_Type::BEFORE];
    }
    
    /**
     * Returns a composite that holds the afterReturning advices.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function afterReturning()
    {
        return $this->advicesByType[AspectPHP_Advice_Type::AFTER_RETURNING];
    }
    
    /**
     * Returns a composite that holds the afterThrowing advices.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function afterThrowing()
    {
        return $this->advicesByType[AspectPHP_Advice_Type::AFTER_THROWING];
    }
    
    /**
     * Returns a composite that holds the after advices.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function after()
    {
        return $this->advicesByType[AspectPHP_Advice_Type::AFTER];
    }
    
    /**
     * Merges all advices of the given container into this container.
     *
     * The given container is not modified.
     *
     * @param AspectPHP_Advice_Container $container
     * @return AspectPHP_Advice_Container
     */
    public function merge(AspectPHP_Advice_Container $container)
    {
        foreach ($this->advicesByType as $type => $composite) {
            /* @var $type string */
            /* @var $composite AspectPHP_Advisor_Composite */
            $composite->merge($container->advicesByType[$type]);
        }
        return $this;
    }
    
    /**
     * Returns the number of added advices.
     *
     * @return integer
     */
    public function count()
    {
        $numberOfAdvices = 0;
        foreach ($this->advicesByType as $composite) {
            /* @var $composite AspectPHP_Advisor_Composite */
            $numberOfAdvices += count($composite);
        }
        return $numberOfAdvices;
    }
    
}