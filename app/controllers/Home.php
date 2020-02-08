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
            'usr_name' => "Mark2",
            'usr_surname' => "Zuckerberg3",

        ];
       // $users = $db->delete('user',5);
        $columns = $db->getColumns('user');
        dnd($columns);
        $this->view->render('default');
    }

}