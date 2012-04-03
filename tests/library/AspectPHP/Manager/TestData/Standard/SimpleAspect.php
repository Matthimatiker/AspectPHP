<?php

/**
 * Standard_SimpleAspect
 *
 * @category PHP
 * @package AspectPHP_Manager
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 03.04.2012
 */

/**
 * An aspect with a simple advice based on a RegExp pointcut.
 *
 * @category PHP
 * @package AspectPHP_Manager
 * @subpackage Tests
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 03.04.2012
 */
class Standard_SimpleAspect implements AspectPHP_Aspect
{
    
    /**
     * Returns a pointcut that matches all method of a "User" class.
     *
     * @return AspectPHP_Pointcut
     */
    public function pointcutMethodsOfUser()
    {
        return new AspectPHP_Pointcut_RegExp('User::.*');
    }
    
    /**
     * An after dummy advice.
     *
     * @after pointcutMethodsOfUser()
     */
    public function afterAdvice()
    {
    }
    
}