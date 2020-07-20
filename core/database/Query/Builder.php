<?php
class Builder{

 private $connection,$grammer,$model;
 public $from;

 /**
  * The current query value bindings.
  *
  * @var array
  */

 public $bindings = [
     'select' => [],
     'from' => [],
     'join' => [],
     'where' => [],
     'groupBy' => [],
     'having' => [],
     'order' => [],
     'union' => [],
     'unionOrder' => [],
 ];

 public $wheres = [];

  public function __construct(){

    $this->connection = new Connection();
    $this->grammer = new Grammer();

  }

  public function insert($values){

      $insert_statement = $this->grammer->compileInsert($this,$this->model->get_fields());
      $this->connection->insert($insert_statement);

  }

  public function getTableColumns(){

      $show_columns_statement = $this->grammer->compileShowColumns($this);
      return $this->connection->getTableColumns($show_columns_statement);

  }

  public function where($column, $operator = null, $value = null , $boolean = 'and'){

       $value  = func_num_args() === 2 ? $operator : $value;
       $operator  = func_num_args() === 2 ? '=' : $operator;

       //add value and operator to the where's array
       $this->wheres = compact("operator","value","column");

       $this->addBinding('where',$value);

       return $this;

  }

  //execute a query as a select statemtn
   public function get(){

      $select_statement = $this->grammer->compileSelect($this);
      print_r($this->connection->get($select_statement));
    //  return $this->connection-get($select_statement);

   }

  //add binding to a querying
  public function addBinding($type,$value){

      $this->bindings[$value][] = $value;
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
