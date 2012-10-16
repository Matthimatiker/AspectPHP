# Aspect PHP # 

Master: [![Build Status](https://secure.travis-ci.org/Matthimatiker/AspectPHP.png?branch=master)](http://travis-ci.org/Matthimatiker/AspectPHP)

AspectPHP brings Aspect Oriented Programming to PHP. 

It allows hooking into most of the class methods that are not 
provided by the PHP Core.

## Requirements ##

AspectPHP requires at least *PHP 5.3*. No additional packages or 
extensions are required.

## Installation ##

### Composer ###

Add the github repository to your composer config and require
*matthimatiker/aspectphp*:

    {
        "repositories": [
             {
                 "type": "vcs",
                 "url": "https://github.com/Matthimatiker/AspectPHP"
             }
        ],
        "require": {
            "matthimatiker/aspectphp" : "dev-master"
        }
    }
    
Install AspectPHP via 

    php composer.phar install

## Configuration ##

Before using AspectPHP the environment must be initialized.

Add the following lines after setting the include path:

    // Set up your include path here.
    
    $environment = new AspectPHP_Environment();
    $environment->initialize();

## Usage ##

### Create Aspect ###

Aspects are simple classes that implement the *AspectPHP_Aspect* 
interface:

    class DemoAspect implements AspectPHP_Aspect
    {
    }
    
Aspect classes contain *advices* and *pointcuts*. Advice methods contain 
the code that is executed if an extension point is reached. Pointcuts 
identify the extension points that trigger the advice. Annotations are 
used to bind pointcuts to advices:

    class DemoAspect implements AspectPHP_Aspect
    {
        
        /**
         * @return AspectPHP_Pointcut
         */
        public function pointcutDemoMethods()
        {
            return new AspectPHP_Pointcut_RegExp('Demo::.*');
        }
        
        /**
         * Outputs the method name before its execution.
         *
         * @param AspectPHP_JoinPoint $joinPoint
         * @before pointcutDemoMethods()
         */
        public function beforeExecution(AspectPHP_JoinPoint $joinPoint)
        {
            echo 'before ' . $joinPoint->getMethod() . PHP_EOL;
        }
        
    }
    
This aspect contains an advice (*beforeExecution()*) that references 
a pointcut (*pointcutDemoMethods()*). The advice will be executed 
whenever a method of the *Demo* class is executed.

The used annotation determines when an advice is executed in relation
to the method that triggered it:

* before         - The advice is executed before the method.
* afterReturning - The advice is executed when the method returned a 
                   value or finished, but not if an exception was
                   thrown.
* afterThrowing  - The advice is only executed if the method throws
                   an exception.
* after          - The advice is executed after the method, regardless 
                   whether the method finished with a return value
                   or an exception.

### Register Aspect ###

To activate an aspect an instance of the class must be registered at the 
aspect manager.

The manager can be retrieved from the environment:

    $manager = $environment->getManager();
    
The *register()* method is used to add the aspect:

    $manager->register(new DemoAspect());
    
Afterwards each call to a *Demo* method triggers the *beforeExecution()*
advice:

    $demo = new Demo();
    // Displays "before sayHello" and executes sayHello() afterwards.
    $demo->sayHello();