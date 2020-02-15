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
        $users = $db->find('person',
                    [
                        'conditions' => ["usr_name = ?"],
                        'bind' => ['Mark2'],
                    ]);

        dnd($users);
        $this->view->render('default');

    }

}