<?php
namespace core\database\query;
use  core\database\Connection;
use core\database\Model;
use core\database\query\grammers\Grammer;

class Builder{

 private $connection,$grammer;
 public $from,$model,$last_insert_id;

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
     $result = $this->connection->get($select_statement);

     if(!empty($this->model)){
         dnd('wer are  here we are here for ever');
        return $this->return_results_as_model($result);
      }else{

        return $this->return_result_as_array($result);
      }

   }
   public function return_results_as_model($result){
     $objectsArr = [];
      foreach($result as $result){
          $obj = new $this->model();
          $obj->populate_object_data($result);
          $objectsArr[] = $obj;
      }

      return $objectsArr;
   }

   public function return_result_as_array($result_obj){
     $results_ = [];
       foreach($result_obj as $results_arr => $result_arr){

           foreach($result_arr as $key => $val){
              $results_[$results_arr][$key] = $val;
           }

         }
       return $results_;
   }

   public function populate_object_data($result){
       foreach($result as $key => $val){
        //   dnd($key);
           $this->$key = $val;
       }
   }

   public function set_model_attribute_values($query_result){

        foreach ($query_result as $key => $obj) {
          foreach ($obj as $column => $value) {
          $this->model->$column = $value;
        }
       }

   }

  //add binding to a querying
  public function addBinding($type,$value){

      $this->bindings[$value][] = $value;
  }

  public function setModel(Model $model){

      $this->model = $model;
      $this->from = $model->getTable();

  }

  private function buildUpdate(){

  }

  public function getConnection(){
    return $this->connection;
  }

  private function buildDelete(){

  }

  public function table($table){
    $table = $table[0];
    $newBuilder = new Builder();
    $newBuilder->from = $table;
    return $newBuilder;
  }

}
?>
