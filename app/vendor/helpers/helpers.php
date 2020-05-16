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

function currentPage(){
    $current_page = $_SERVER['REQUEST_URI'];
    if($current_page == ROOT || $current_page == ROOT.'home/index'){
        $current_page = ROOT.'home';
    }
    return $current_page;
}

function url($path){
    if(ENVIROMENT == 'Development'){
        echo "http://".$_SERVER['HTTP_HOST']."/". strtolower(SITE_NAME).'/'.$path;
    }else{
        echo "http://".$_SERVER['HTTP_HOST']."/".$path;
    }

}