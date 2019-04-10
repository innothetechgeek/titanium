<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-04-10
 * Time: 21:42
 */

trait View
{
    protected $head, $body,$siteTitle, $outputBuffer, $layout = DEFAULT_LAYOUT;

    public function __construct()
    {

    }

    public function render($viewName){
        $viewArray  = explode('/',$viewName);
        $viewString = implode(DS,$viewArray);

        if(file_exists(ROOT .DS .'app'. DS. $viewString .'.pgp')){
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString .'php');
            include(ROOT . DS . 'app' . DS . 'voews' . DS . 'layouts' . DS . $this->layout . '.php');
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
}