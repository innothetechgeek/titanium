<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-31
 * Time: 01:24
 */

class Router
{
    private static $valid_routes = [];

    //method not allowed method

    //get method
    public static function get($route,$function){
      array_push(self::$valid_routes,Array(
         'path' => $route,
         'function' => $function,
      ));
    }

    //route method
    public static function route($url){
      unset($url[2]);
     /*loop through the list of valid routes, check if url matches a route in the list of valid routes
          if request url matches method and class, call relevent method and class */
      $route_found = false;
      foreach (self::$valid_routes as $route) {

        //if path in the list of valid routes matches current request path, call relevent class and method
        if($route['path'] == implode($url,'/')){

            $route_found = true;
            $class_method = explode('@',$route['function']);

            if(empty($url)){
              $class =  DEFAULT_CONTROLLER;
                $method =  "index";
            }else{
              $class = $class_method[0];
              $method =  $class_method[1];
            }

            //acl check - grant or deny access
            $grantAccess = self::hasAccess($class,$method);

            if(!$grantAccess){
                $class = ACCESS_RESTRICTED;
                $method = ACCESS_RESTRICTED_METHOD;
            }

            $controller_obj = new $class(ucfirst($class),$method);
            $queryParams = [];

            if(method_exists($class,$method)){
                call_user_func_array([$controller_obj,$method],$queryParams);
            }else{
                die('That method does not exist in the controller '.$class);
            }
            break;
        }
      }
      if(!$route_found) Router::redirect('titanium/page-not-found');
    }

    public function map_request(){

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



}
