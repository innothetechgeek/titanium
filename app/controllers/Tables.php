<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-16
 * Time: 01:38
 */

class Tables extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function simple(){
        $this->view->render('admin_lte_template/tables/simple_tables');
    }

    public function data_tables(){
        $this->view->render('admin_lte_template/tables/datatables');
    }

}