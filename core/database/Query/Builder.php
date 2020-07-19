<?php
class Builder{

 private $connection,$grammer;

  public function __construct(){

    $this->connection = new Connection();
    $this->grammer = new Grammer();

  }

  private function buildInsert($values){

      $insert_statement = $this->grammer->complieInsert();
      $this->connection->insert($this,$insert_statement);

      );
  }

  private function buildUpdate(){

  }

  private buildDelete(){

  }

}
?>
