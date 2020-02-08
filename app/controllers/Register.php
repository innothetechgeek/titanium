<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 01:22
 */

class Register extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model();
    }

    public function login(){
        echo password_hash('password',PASSWORD_DEFAULT);
        $this->view->render('register');
    }
}