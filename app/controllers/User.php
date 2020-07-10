<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 01:22
 */

class User extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function login(){

        if(currentUser()) Router::redirect('movies');
        if($_POST){
            $user = new Person();
            $user = $user->findByUsername(Input::get('usr_email'));
           if($user && md5(Input::get('password')) == $user->usr_password){

               $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;

               $user->login($remember);
               if(isset($_POST['login_required']) && $_POST['login_required'] != '' ){
                   Router::redirect('movies/add');
               }else{
                   Router::redirect('movies');
               }

           }
        }

       $this->view->render('user/login');

    }


    public function register(){

        $this->view->render('user/register');

    }

    public static function registerUser(){

        $user = new Person();
        $user->usr_name = Input::get('name');
        $user->usr_email = Input::get('email');
        $user->usr_password = md5(Input::get('password'));
        $user->save();

    }

    public function acls(){
        if(empty($this->acl)) return [];
        return json_decode($this->acl,true);
    }

    public function logout(){
        currentUser()->logOut();
        Router::redirect(url(''));
    }

    public function registration_successful(){
        $this->view->render('user/registration_successful');
    }
}
