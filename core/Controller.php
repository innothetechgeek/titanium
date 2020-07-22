<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-04-10
 * Time: 21:35
 */
namespace core;
use core\View;

class Controller extends \core\Application
{
    protected $controller,$action;
    public $view;

    public function __construct($controller,$action){
        parent::__construct();
        $this->view = new View();
    }

    /*protected function load_model($model){
        if(class_exists($model)){

            $this->$model =  new  $model(strtolower($model));
        }
    } */

}
