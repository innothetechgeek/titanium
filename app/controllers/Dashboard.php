<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-15
 * Time: 22:53
 */

class Dashboard extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function index(){
       return view('admin_lte_template/dashboard/dashboard');
    }

    public function version1(){

       return view('admin_lte_template/dashboard/version1');

    }
}
