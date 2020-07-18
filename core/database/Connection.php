<?php
class Connection{

  private $connection;
  private function __construct(){
      try{

          $this->connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);

      }catch(PDOException $e){

          die($e->getMessage());

      }

  }

  private function execute_statement(){

  }

  private function bindValues(){

  }

}
?>
