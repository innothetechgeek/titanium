<?php
namespace core\view;
/*
 * @Author: Khusela Mphokeli 
 * @Date: 2020-08-05 01:49:49 
 * @Last Modified by:   Khusela Mphokeli 
 * @Last Modified time: 2020-08-05 01:49:49 
 */



class Factory{

    public function __construct(){
    }

    public function make($name,$data,$path){
           
        $view = new View($this,$name,$data,$path);
        return $view->render();

    }
}