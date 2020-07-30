<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 16:16
 */
namespace core;
class Cookie
{
    public static function set($name,$value,$expiriry){
        if(setcookie($name,$value,time()+$expiriry)){
            return true;
        }
        return false;
    }

    public static function delete($name){
        self::set($name,'',time()-1);
    }

    public static function get($name){

        return $_COOKIE[$name];
    }

    public static function exists($name){
        return isset($_COOKIE[$name]);
    }

}
