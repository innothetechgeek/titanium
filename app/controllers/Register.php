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
        $this->load_model('User');
    }

    public function login(){
        if($_POST){
           $user = $this->User->findByUsername(Input::get('user_name'));
           if($user && verify_password($_POST['password'])){
               $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
               $user->login($remember);
                   //echo "hello";
                  Router::redirect('');
           }
        }
        $this->view->render('register/login');
    }

    public function verify_password($password){

    }

    public function register(){

        $this->view->render('register/register');

    }

    public static function registerUser(){

        $user = new User();
        $user->save();
    }
}