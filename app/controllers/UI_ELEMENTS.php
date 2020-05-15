<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-15
 * Time: 02:11
 */

class UI_ELEMENTS extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function general(){
        $this->view->render('admin_lte_template/ui/general');
    }

}