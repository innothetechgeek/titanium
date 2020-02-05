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

            if($this->query->execute($params)){
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

        $sql = "INSERT INTO {$table} ({$fieldsString}) VALUES($valueString)";
        if(!$this->query($sql,$values)->error()){
            return true;
        }

        return false;
    }

    public function update($table, $id,$fields = []){
        $fieldString = "";
        $values = [];
        foreach($fields as $field => $value){
            $fieldString .= " ". $field . " =?,";
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString,",");
        dnd($fieldString);
        dnd($values);
        $sql = "UPDATE {$table} SET {$fieldString} where usr_id = {$id}";
        if(!$this->query($sql,$values)->error()){
           // return true;
        }
       // return false;
    }

    public function error(){
       // dnd($this->pdo->errorInfo());
        return $this->error;
    }

}