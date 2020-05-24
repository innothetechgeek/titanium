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
        //$user = new Person();
        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        $controller_name = ucfirst($controller);
        array_shift($url);

        //action
        $method = (isset($url[0]) && $url[0] != '') ? $url[0] : "index";
        $method_name = $method;
        array_shift($url);

        //acl check
        $grantAccess = self::hasAccess($controller_name,$method_name);


        if(!$grantAccess){
            $controller_name = ACCESS_RESTRICTED;
            $method_name = ACCESS_RESTRICTED_METHOD;
        }

        //parameters
        $queryParams = $url;


        $controller_obj = new $controller_name($controller_name,$method_name);

        if(method_exists($controller_name,$method_name)){
            call_user_func_array([$controller_obj,$method_name],$queryParams);
        }else{
            die('That method does not exist in the controller '.$controller_name);
        }
    }
    public static function hasAccess($controller,$method_name = "index"){

        return true;
        $controller = ucfirst($controller);
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
            //dnd($acl[$level]);
            if(array_key_exists($level,$acl) && array_key_exists($controller,$acl[$level])){
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

    public static function getMenu($menu){

        $menu_arr = [];
        $menu_file = file_get_contents(ROOT.DS.'app'. DS . $menu. '.json');
        $acl = json_decode($menu_file,true);
        foreach ($acl as $key => $val){
            if(is_array($val)){
                $sub = [];
                foreach ($val as $k=>$v){
                    if($k == 'seperator' && !empty($sub)){
                        $sub[$k] = '';
                        continue;
                    }else if($final_val = self::getLink($v)){
                        $sub[$k] = $final_val;
                    }
                }
                if(!empty($sub)){
                    $menu_arr[$key] = $sub;
                }
            }else{
                if($final_val = self::getLink($val )){
                    $menu_arr[$key] = $final_val;
                }
            }
        }
        return $menu_arr;
    }

    private static function getLink($val){
        if(preg_match('/https?:\/\//',$val) ==1){
            return $val;
        }else{
            $u_array = explode(DS,$val);
            $controller_name = ucwords($u_array[0]);
            $action_name = (isset($u_array[1])) ? $u_array[1] : '';
            if(self::hasAccess($controller_name,$action_name)){
                return $val;
            }
            return false;
        }
    }
}
