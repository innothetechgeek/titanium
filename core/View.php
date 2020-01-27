<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-04-10
 * Time: 21:42
 */

class View
{
    protected $head, $body,$siteTitle, $outputBuffer, $layout = DEFAULT_LAYOUT;

    public function __construct()
    {

    }

    public function render($viewName){
        $viewArray  = explode('/',$viewName);
        $viewString = implode(DS,$viewArray);

        if(file_exists(ROOT .DS .'app'. DS. 'views' . DS . $viewString .'.php')){

            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString .'.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . DS . $this->layout . '.php');

        }else{

            die("The view $viewName doesn't exists");

        }
    }

    public function content($type){

        if($type == 'head'){

            return $this->head;

        }else{

            if($type == 'body'){
                return $this->body;
            }

        }
    }

    public function start($type){
        $this->outputBuffer = $type;
        ob_start();
    }

    public function end(){
        if($this->outputBuffer == 'head'){
            $this->head =  ob_get_clean();
        }else if($this->outputBuffer =='body'){
            $this->body = ob_get_clean();
        }else{
            die('You must first run the start method');
        }
    }

    public function siteTitle(){
        if($this->siteTile == '') return SITE_TITLE;
    }

    public function setSiteTitle($title){
        $this->setSiteTitle = $title;
    }

    public function setLayout($path){
        $this->layout = $path;
    }
}