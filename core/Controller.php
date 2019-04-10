<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-04-10
 * Time: 21:35
 */

class Controller extends Application
{
    protected $controller,$action;
    public $view;

    public function __contruct($controller,$action){
        parent::_contruct();
        $this->_controller = $controller;
        $this->action = $action;
        $this->view = new View();
    }

}