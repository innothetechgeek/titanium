<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 01:22
 */
namespace app\controllers;
use core\Controller;
use core\Router;
use core\Input;
use app\models\Person;
class User extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function login(){

        if(currentUser()) Router::redirect('movies');

        if($_POST){
            $user = Person::where('usr_email',Input::get('usr_email'))->first();
             if($user && md5(Input::get('password')) == $user->usr_password){

               $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;

               $user->login($remember);
               if(isset($_POST['login_required']) && $_POST['login_required'] != '' ){

                   Router::redirect('movies/add');
               }else{ dnd('here login method');
                   Router::redirect('movies');
               }

           }
        }

       return view('user/login');

    }


    public function register(){

        return view('user/register');

    }

    public static function registerUser(){

        $user = new Person();
        $user->usr_name = Input::get('name');
        $user->usr_email = Input::get('email');
        $user->usr_password = md5(Input::get('password'));
        $user->save();
        if($user->id){
            return view('user/registration_successful');
        //  Router::redirect('registration-successful');
        }

    }

    public function acls(){
        if(empty($this->acl)) return [];
        return json_decode($this->acl,true);
    }

    public function logout(){
        currentUser()->logOut();
        Router::redirect('');
    }

    public function registration_successful(){
        return view('user/registration_successful');
    }
}
