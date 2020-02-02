<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-02
 * Time: 11:10
 */

class DB
{
    private static $instance = null;
    private $pdo, $query, $error = false, $result, $count = 0, $last_insert_id;


    private function __construct(){
        try{

            $this->pdo = new PDO('mysql:host=127.0.0.1:8080;dbname=tatanium','db user','password');

        }catch(PDOException $e){

            die($e->getMessage());

        }

    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new DB();
        }
        return self::$instance;
    }

}