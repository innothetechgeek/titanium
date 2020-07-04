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
         'expression' => $expression,
         'function' => $function,
      ));
    }

    //route method
    public static function route($url){

     /*loop through the list of valid routes, check if url matches a route in the list of valid routes
          if request url matches method and class, call relevent method and class */
      foreach (sef::$valid_routes as $route) {

        //if path in the list of valid routes matches current request path, call relevent class and method
        if($route['path'] == implode(url,'/'){
                    
          //acl check - grant or deny access
          $grantAccess = self::hasAccess($controller_name,$method_name);

          if(!$grantAccess){
              $controller_name = ACCESS_RESTRICTED;
              $method_name = ACCESS_RESTRICTED_METHOD;
          }

          $class_method = explode($route['function'],'@');
          $class = $class_method[0];
          $method =  $class_method[1];

          $controller_obj = new $class($class,$method);

          if(method_exists($class,$method)){
              call_user_func_array([$controller_obj,$method],$queryParams);
          }else{
              die('That method does not exist in the controller '.$controller_name);
          }

          break;

        }

      }
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
