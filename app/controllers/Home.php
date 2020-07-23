<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-04-21
 * Time: 16:46
 */
 namespace app\controllers;
 use core\Controller;
 use app\models\Genre;

class Home extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function index(){

        $genres = \app\models\Genre::where('gnr_name',"Romance")->get();
        dnd($person);
      //  $person::where('usr_name',"Jessica Anthony")->get();
      // dnd($person);
      //  $person->save();
        $this->view->render('index');

    }
    public function page_not_found(){
        $this->view->render('page_not_found');
    }

}
