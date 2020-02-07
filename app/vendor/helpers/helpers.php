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