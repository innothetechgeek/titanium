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
 use core\support\fecade\DB;

class Home extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function index(){

       $genres = DB::table('genre')->select()->leftJoin('mv_genre', 'mv_genre.mvg_ref_genre', '=', 'genre.gnr_id')->get();

       // $genres = \app\models\Genre::all();
      // dnd($genres);
      //$genres = new Genre();
      //$genres->gnr_name = 'isisheli';
        // $genres->save();
      //  $person::where('usr_name',"Jessica Anthony")->get();
      // dnd($person);
      //  $person->save();
        $this->view->render('index');

    }
    public function page_not_found(){
        $this->view->render('page_not_found');
    }

}
