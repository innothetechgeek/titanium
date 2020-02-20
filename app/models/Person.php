<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-08
 * Time: 16:45
 */

class Person extends Model
{
    private $is_loggedIn, $session_name, $cookieName;
    public static $currentLoggedInUser = null;

    public function __construct($user = '')
    {

        $table = 'person';
        parent::__construct($table);
        $this->session_name = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->soft_delete = true;
         if ($user != '') {
             if (is_int($user)) {
                 $u = $this->db->first('person', ['condition' => 'id = ?', 'bind=' => [$user]]);
             } else {
                 $u = $this->db->first('person', ['condition' => 'id = ?', 'bind=' => [$user]]);
             }

             if ($u) {
                 foreach ($u as $key => $val) {
                     $this->$key = $val;
                 }
             }
         }
    }

    public function findByUsername($username){
        return $this->find_first(['conditions'=>['usr_name =?'],'bind'=>[$username]]);
    }

    public function login($rememberMe = false){
        Session::set($this->session_name,$this->id);
        if($rememberMe){
            $hash = md5(uniqid(+rand(0,100)));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->cookieName,$hash,REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session'=>$hash,'user_agent'=>$user_agent,'user_id'=>$this->id];
            $this->db->query('DELETE FROM user_sessions where usr_id = ? AND usr_agent =?',[$this->id,$user_agent]);
            $this->db->insert('user_sessions',$fields);
        }
    }
}