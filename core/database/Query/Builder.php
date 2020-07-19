<?php
class Builder{

 private $connection,$grammer,$model;
 public $from;

  public function __construct(){

    $this->connection = new Connection();
    $this->grammer = new Grammer();

  }

  public function insert($values){

      $insert_statement = $this->grammer->compileInsert($this,$this->model->get_fields());
      $this->connection->insert($insert_statement);

  }

  public function setModel(Model $model){

      $this->model = $model;
      $this->from = $model->table;

  }

  private function buildUpdate(){

  }

  private function buildDelete(){

  }

}
?>
