<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-15
 * Time: 02:21
 */

class FORMS extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function general(){

        return view('admin_lte_template/forms/general');

    }

    public function advanced(){

        return view('admin_lte_template/forms/advanced');

    }

    public function editors(){

       return view ('admin_lte_template/forms/editors');

    }

    public function validation(){

    }

}