<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-04-21
 * Time: 16:46
 */

class Home extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function index(){
        $db = DB::getInstance();
        $fields = [
            'usr_name' => "Mark",
            'usr_surname' => "Zuckerberg",
            'usr_email' => "mark@facebook.com",

        ];
        $users = $db->insert('user',$fields);
        $this->view->render('home/index');
    }

}