<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-16
 * Time: 03:01
 */
 namespace app\controllers;
 use core\Controller;
 use core\Paginator;
 use app\models\Genre;
 use app\models\Movie;
 use app\models\Person;
 use core\support\fecade\DB;

class Movies extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public function add(){

       if(!currentUser()) Router::redirect('user/login?login-required=true');

        if($_POST) {

            $movie_id = $this->create_movie();
            $this->create_movie_genre($movie_id);
            Router::redirect('movies/movie-added=true');

        }else{

            $genre = new Genre();
            $genres = $genre->select("select * from genre");
            $this->view->genres = $genres;
            $this->view->render('movies/add');

        }

    }

    public function view($param = []){


        $movie = new Movie();

        $movies = $movie->all();

        $rows_found = count((array)$movies);
dnd($rows_found);
        $paginator = new Paginator($rows_found,10);
        $pagination_links = $paginator->get_pagination_links();
        $this->view->pagination_links = $pagination_links;

        $limit_and_offset = $paginator->get_offset_and_limit();

        $movies = DB::table('movie')->select()
                  ->leftJoin('mv_genre', 'mv_genre.mvg_ref_movie', '=', 'movie.mv_id')
                  ->leftJoin('genre', 'mv_genre.mvg_ref_genre', '=', 'genre.gnr_id')
                  ->get();
        $this->view->movies = $movies;
        $this->view->rows_found = $rows_found;
        $this->view->count = $rows_found;
        $this->view->offset = $paginator->get_offset();
        $refer = parse_url($_SERVER['HTTP_REFERER'])['path'];
         if(strpos($refer, 'movies/add') !== false) $this->view->movie_added = true;

        if(currentUser()){
            $this->view->render('movies/list');
        }else{
            $this->view->render('movies/list_home');
        }


    }

    public function create_movie(){

        $movie = new Movie();
        $movie->mv_title = Input::get('mv_title');
        $date_released = str_replace('/','-',Input::get('mv_year_released'));
        $movie->mv_year_released = format_date("Y-m-d",$date_released);
        $movie_id = $movie->save();
        return $movie_id;

    }

    public function create_movie_genre($movie_id){


        $movie_genres = $_POST['genres'];

        foreach ($movie_genres as $key => $genre_id) { //creates movie genre(s)
            $movie_genre = new MovieGenre();
            $movie_genre->mvg_ref_genre = $genre_id;
            $movie_genre->mvg_ref_movie = $movie_id;
            $movie_genre->save();
        }


    }


}
