<?php
namespace core\view;
class Factory{

    public function __construct(){
    }

    public function make($name,$data,$path){
           
        $view = new View($this,$name,$data,$path);
        return $view->render();

    }
}