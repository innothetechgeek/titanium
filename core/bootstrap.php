<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-28
 * Time: 22:10
 */
 use core\Router;

//load configuration and helper functions
    require_once(ROOT . DS . 'config' . DS . 'config.php');
    require_once(ROOT . DS. 'vendor' . DS . 'helpers' . DS . 'functions.php');

    //Autoload classes
     /*load classes automantically....make classes available to this file
        the class name will be passed to this method as a parameter when the class is being instantiated
     */
  //  spl_autoload_register('autoloader'); //Deprecated function spl_autoload_register()

    spl_autoload_register(function($className){
        $className = str_replace("\\", '/' ,$className);
        require_once($className.'.php');
    });

    require_once(ROOT . DS . 'routes' . DS .'routes.php');

    //Route Requests
    Router::route($url);
