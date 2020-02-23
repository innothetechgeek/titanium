<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-31
 * Time: 01:24
 */

class Router
{
    public static function route($url){
        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        $controller_name = $controller;
        array_shift($url);

        //action
        $method = (isset($url[0]) && $url[0] != '') ? $url[0] : "index";
        $method_name = $method;
        array_shift($url);

        //parameters
        $queryParams = $url;

        $controller_obj = new $controller($controller_name,$method);

        if(method_exists($controller,$method)){
            call_user_func_array([$controller_obj,$method],$queryParams);
        }else{
            die('That method does not exist in the controller '.$controller_name);
        }
    }

    public static function redirect($location){
        //dnd(ROOT."/".$location);
            $location = "../".$location;
           header('Location: '.$location);
    }
}
