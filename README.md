# Aspect PHP #

AspectPHP brings Aspect Oriented Programming to PHP. 

It allows hooking into most of the class methods that are not 
provided by the PHP Core.

## Requirements ##

AspectPHP requires at least *PHP 5.3*. No additional packages or 
extensions are required.

## Concept ##

## Installation ##

### Composer ###

Add the github repository to your composer config and require
*Matthimatiker/AspectPHP*:

    {
        "repositories": [
             {
                 "type": "vcs",
                 "url": "https://github.com/Matthimatiker/AspectPHP"
             }
        ],
        "require": {
            "Matthimatiker/AspectPHP" : "dev-master"
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
