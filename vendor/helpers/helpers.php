<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-31
 * Time: 01:02
 */

function dnd($data){
    
    echo '<pre>';
        var_dump($data);
    echo '</pre>';
}

function sanitize($dirty){
    return htmlentities($dirty, ENT_QUOTES,'UTF-8');
}
//===================================================================================================
function currentPage(){
    $current_page = $_SERVER['REQUEST_URI'];
    if($current_page == ROOT || $current_page == ROOT.'home/index'){
        $current_page = ROOT.'home';
    }
    return $current_page;
}
//===================================================================================================
function url($path){
    if(ENVIROMENT == 'Development'){
        echo "http://".$_SERVER['HTTP_HOST']."/". strtolower(SITE_NAME).'/'.$path;
    }else{
        echo "http://".$_SERVER['HTTP_HOST']."/".$path;
    }
}
//===================================================================================================
function format_date($format,$date){
    return date($format, strtotime($date));
}
//===================================================================================================
function currentUser(){
    return app\models\Person::currentUser();
}

function view($name,$data){
    $path = ROOT . DS . 'app' . DS . 'views' . DS . $name .'.php';
   
    $viewFactory = new core\view\Factory();    
    
    return $viewFactory->make($name,$data,$path);
}

if (! function_exists('e')) {
    /**
     * Encode HTML special characters in a string.
     *
     * @param  \Illuminate\Contracts\Support\DeferringDisplayableValue|\Illuminate\Contracts\Support\Htmlable|string  $value
     * @param  bool  $doubleEncode
     * @return string
     */
    function e($value, $doubleEncode = true)
    {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', $doubleEncode);
    }
}