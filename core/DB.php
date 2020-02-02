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

            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);

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

    public function  query($sql, $params = []){

        $this->error = false;
        if($this->query = $this->pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->query->bindParam($x,$param);
                    $x++;
                }
            }

            dnd($this->query);
            if($this->query->execute()){
                dnd('we got here');

                $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();
                $this->last_insert_id = $this->pdo->lastInsertId();
            }else{

                $this->error = true;
            }
        }

        return $this;

    }

    public function insert($table,$fields = []){
        $fieldsString = "";
        $valueString = "";

        foreach($fields as $field => $value){
            $fieldsString .= "$field,";
            $valueString .= "?,";
            $values[] =  $value;
        }

        $fieldsString = rtrim($fieldsString,",");
        $valueString = rtrim($valueString,",");

        dnd($table);
        $sql = "INSERT INTO {$table} ({$fieldsString}) VALUES($valueString)";
        if(!$this->query($sql,$values)->error()){

            return true;
        }

        dnd($this->pdo->errorInfo());
        return false;
    }

    public function error(){
        return $this->error;
    }

}