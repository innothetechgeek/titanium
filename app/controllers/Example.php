<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-01-27
 * Time: 12:13
 */

class Example extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function index(){

       return view('examples/example1');
       
    }
}