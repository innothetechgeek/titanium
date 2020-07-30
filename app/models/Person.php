<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 16:45
 */
namespace app\models;
use core\database\model;
use core\Session;

class Person extends Model
{
    private $is_loggedIn, $session_name, $cookieName;
    public static $currentLoggedInUser = null;
    public $primary_key = 'usr_id';
    protected $table = 'person';

    public function __construct($user = '')
    {


        $table = 'person';
        parent::__construct($table);
        $this->session_name = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;

        $this->soft_delete = true;
         if ($user != '') {
             if (is_int($user)) {
                 $u = $this->find($user);
             } else {
                 $u = $this->find($user);
             }

             if ($u) {
                 foreach ($u as $key => $val) {
                     $this->$key = $val;
                 }
             }
         }

    }
    //===================================================================================================

    public function findByUsername($username){

        return $this->where('usr_email',$username)->get();

    }

    //===================================================================================================

    public static function currentUser(){

        if(isset(self::$currentLoggedInUser)) return self::$currentLoggedInUser;

        if(Session::exists(CURRENT_USER_SESSION_NAME)){
            self::$currentLoggedInUser =  self::find(Session::get(CURRENT_USER_SESSION_NAME))[0];

        }

        return self::$currentLoggedInUser;

    }

    //===================================================================================================
    public function login($rememberMe = false){

        Session::set($this->session_name,$this->usr_id);

        if($rememberMe){
            $hash = md5(uniqid(+rand(0,100)));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->cookieName,$hash,REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session'=>$hash,'user_agent'=>$user_agent,'user_id'=>$this->id];
            $this->db->query('DELETE FROM user_sessions where usr_id = ? AND usr_agent =?',[$this->id,$user_agent]);
            $this->db->insert('user_sessions',$fields);
        }
    }
    //===================================================================================================

    public function logOut(){

        $user_agent = Session::uagent_no_version();
        $this->db->query("DELETE from user_sessions where user_id = ? and user_agent ?",[$this->id,$user_agent]);
        Session::delete(CURRENT_USER_SESSION_NAME);
        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;

    }
}
