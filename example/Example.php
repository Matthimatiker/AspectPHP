<?php

/**
 * Example script.
 *
 * @author Matthias Molitor <matthias@matthimatiker.de>
 * @package AspectPHP
 * @subpackage Example
 * @copyright Matthias Molitor 2012
 * @version $Rev$
 * @since 16.01.2012
 */

/**
 * Initialize environment.
 */
require_once(dirname(__FILE__) . '/../Environment.config.php');

$manager = new AspectPHP_Manager_Standard();
AspectPHP_Container::setManager($manager);
AspectPHP_Stream::register();

set_include_path('aspectphp://' . dirname(__FILE__) . PATH_SEPARATOR . get_include_path());

class DemoAspect implements AspectPHP_Aspect {
    
    /**
     * @see AspectPHP_Aspect::before()
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function before(AspectPHP_JoinPoint $joinPoint) {
        echo 'before ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * @see AspectPHP_Aspect::afterReturning()
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterReturning(AspectPHP_JoinPoint $joinPoint) {
        echo 'after ' . $joinPoint->getMethod() . PHP_EOL;
    }
    
    /**
     * @see AspectPHP_Aspect::afterThrowing()
     *
     * @param AspectPHP_JoinPoint $joinPoint
     */
    public function afterThrowing(AspectPHP_JoinPoint $joinPoint) {
        
    }
    
}
$manager->register(new DemoAspect(), 'Demo::sayHello');

$demo = new Demo();
// Should output:
// before sayHello
// Hello Matthias!
// after sayHello
$demo->sayHello('Matthias');

?>