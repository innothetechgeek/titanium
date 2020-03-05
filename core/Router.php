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

        //acl check
        $grantAccess = self::hasAccess($controller,$method_name);

        if(!$grantAccess){
            $controller_name = ACCESS_RESTRICTED;
        }

        //parameters
        $queryParams = $url;

        $controller_obj = new $controller($controller_name,$method);

        if(method_exists($controller,$method)){
            call_user_func_array([$controller_obj,$method],$queryParams);
        }else{
            die('That method does not exist in the controller '.$controller_name);
        }
    }
    public static function hasAccess($controller,$method_name = "index"){
        $acl_file = file_get_contents(ROOT . DS . 'app' . DS . "acl.json");
        $acl = json_decode($acl_file,true);
        $current_user_acls = ["Guest"];
        $grantAccess = false;

        if(Session::exists(CURRENT_USER_SESSION_NAME)){
            $current_user_acls[] = "LoggedIn";
            foreach($current_user_acls()->acl() as $acl){
                $current_user_acls = $acl;
            }
        }

        foreach($current_user_acls as $level){
            if(array_key_exists($level) && array_key_exists($controller,$acl[$level])){
                if(in_array($method_name,$acl[$level][$controller]) || in_array("*",$acl[$level][$controller])){
                    $grantAccess = true;
                    break;
                }
            }
        }

        //check for denied
        foreach($current_user_acls as $level){
            $denied = $acl[$level]['denied'];
            if(!empty($denied) && array_key_exists($controller,$denied) && in_array($method_name,$denied[$controller])){
                $grantAccess = false;
                break;
            }
        }
        return $grantAccess;
    }

    public static function redirect($location){
        //dnd(ROOT."/".$location);
            $location = "../".$location;
           header('Location: '.$location);
    }
}
