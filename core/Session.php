<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 15:58
 */

class Session
{
    public static function exists($name){
        return (iseert($_SESSION[$name])) ? true : false;
    }

    public static function get($name){
        return $_SESSION[$name];
    }

    public static function set($name,$value){

        return $_SESSION[$name] = $value;
    }

    public static function delete($name){
        if(self::exist($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function uagent_no_version(){
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\[a-zA-Z0-9.]+/';
        $newString = preg_replace($regx,'',$uagent);
        return $newString;
    }

}