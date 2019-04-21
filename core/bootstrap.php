<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-28
 * Time: 22:10
 */
//load configuration and helper functions
    require_once(ROOT . DS . 'config' . DS . 'config.php');
    require_once(ROOT . DS . 'app' . DS. 'vendor' . DS . 'helpers' . DS . 'functions.php');

    //Autoload classes
    function __autoload($className){ //Deprecated function spl_autoload_register()

        if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')){
             require_once(ROOT . DS . 'core' . DS . $className . '.php');
        }elseif (file_exists(ROOT . DS . 'app' . DS .'controllers'. DS . $className . '.php')){
            require_once(ROOT . DS . 'app' . DS .'controllers'. DS . $className . '.php');
        }elseif (file_exists(ROOT . DS . 'app' . DS .'models'. DS . $className . '.php')){
            require_once(ROOT . DS . 'app' . DS .'models'. DS . $className . '.php');
        }
    }


    //Route Requests
     Router::route($url);