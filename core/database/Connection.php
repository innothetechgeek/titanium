<?php
class Connection{

  private $connection;
  public function __construct(){
      try{

          $this->connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }catch(PDOException $e){

          die($e->getMessage());

      }

  }

  public function insert($sql){

      $this->connection->exec($sql);

  }

  public function getTableColumns($sql){

       $columns = [];
       foreach($this->connection->query($sql)->fetchAll() as $key => $value){
          $columns[] = $value['Field'];
       }
       return $columns;
       
  }

  private function bindValues(){

  }

}
?>
