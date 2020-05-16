<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-16
 * Time: 03:01
 */

class Movies extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function add(){
        $this->view->render('movies/add');
    }


}