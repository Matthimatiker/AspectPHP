<?php

/**
 * AspectPHP_Reflection_Advice
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
 * Represents an advice method.
 *
 * @category PHP
 * @package AspectPHP_Reflection
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 15.04.2012
 */
class AspectPHP_Reflection_Advice extends AspectPHP_Reflection_Method
{
    
    /**
     * Returns the referenced pointcuts for the given advice type.
     *
     * Example:
     * <code>
     * $pointcuts = $advice->getPointcutsByType('before');
     * </code>
     *
     * @param string $type
     * @return array(AspectPHP_Reflection_Pointcut)
     */
    public function getPointcutsByType($type)
    {
        
    }
    
}