<?php

/**
 * AspectPHP_Advisor_Container
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.03.2012
 */

/**
 * Container class that holds an arbitrary number of advisors grouped by advice type.
 *
 * The container provides a composite object for each advice type. An arbitrary
 * number of advisors may be added for each type:
 * <code>
 * $container = new AspectPHP_Advisor_Container();
 * $container->before()->add($myAdvisor);
 * </code>
 *
 * @category PHP
 * @package AspectPHP_Advisor
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 29.03.2012
 */
class AspectPHP_Advisor_Container implements Countable
{
    
    /**
     * Contains a composite object for each advice type.
     *
     * The composites contain the added advisors.
     * The name of the advice type (for example "before")
     * is used as key.
     *
     * @var array(string=>AspectPHP_Advisor_Composite)
     */
    protected $advisorsByType = array();
    
    /**
     * Creates the container.
     */
    public function __construct()
    {
        // Initialize the composite objects.
        foreach (AspectPHP_Advice_Type::all() as $type) {
            /* @var $type string */
            $this->advisorsByType[$type] = new AspectPHP_Advisor_Composite();
        }
    }
    
    /**
     * Returns a composite that holds the before advisors.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function before()
    {
        return $this->advisorsByType[AspectPHP_Advice_Type::BEFORE];
    }
    
    /**
     * Returns a composite that holds the afterReturning advisors.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function afterReturning()
    {
        return $this->advisorsByType[AspectPHP_Advice_Type::AFTER_RETURNING];
    }
    
    /**
     * Returns a composite that holds the afterThrowing advisors.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function afterThrowing()
    {
        return $this->advisorsByType[AspectPHP_Advice_Type::AFTER_THROWING];
    }
    
    /**
     * Returns a composite that holds the after advisors.
     *
     * @return AspectPHP_Advisor_Composite
     */
    public function after()
    {
        return $this->advisorsByType[AspectPHP_Advice_Type::AFTER];
    }
    
    /**
     * Merges all advisors of the given container into this container.
     *
     * The provided container is not modified.
     *
     * @param AspectPHP_Advisor_Container $container
     * @return AspectPHP_Advisor_Container
     */
    public function merge(AspectPHP_Advisor_Container $container)
    {
        foreach ($this->advisorsByType as $type => $composite) {
            /* @var $type string */
            /* @var $composite AspectPHP_Advisor_Composite */
            $composite->merge($container->advisorsByType[$type]);
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
        foreach ($this->advisorsByType as $composite) {
            /* @var $composite AspectPHP_Advisor_Composite */
            $numberOfAdvices += count($composite);
        }
        return $numberOfAdvices;
    }
    
}