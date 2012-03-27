<?php

/**
 * AspectPHP_Aspect
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 11.01.2012
 */

/**
 * Marker interface that must be implemented by aspects.
 *
 * An aspect consists of pointcuts and advices. Pointcuts identify methods
 * for code injection and advices contain the code that will be executed.
 *
 * This interface does not require any method. It is used to tag aspect
 * classes and to allow type hinting.
 *
 * @category PHP
 * @package AspectPHP
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @copyright 2012 Matthias Molitor
 * @license http://www.opensource.org/licenses/BSD-3-Clause BSD License
 * @link https://github.com/Matthimatiker/AspectPHP
 * @since 11.01.2012
 */
interface AspectPHP_Aspect
{
    
}