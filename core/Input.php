<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 19:08
 */
namespace core;
class Input
{
    public static function sanitize($dirty){
        return htmlentities($dirty,ENT_QUOTES,"utf-8");
    }

    public static function get($input){
        if(isset($_POST[$input])){
            return self::sanitize($_POST[$input]);
        }else if(isset($_GET[$input])){
            return self::sanitize($_GET[$input]);
        }
    }
}
