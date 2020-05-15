<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-03-05
 * Time: 21:41
 */

class Restricted extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function AccessRestricted(){
        $this->view->render('restricted/index');
    }
}