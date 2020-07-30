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

 public $columns;

 public $limit;


 public $groups;

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

  public function select($columns = ['*']){

      $this->columns = [];
      $this->bindings['select'] = [];
      $columns = is_array($columns) ? $columns : func_get_args();

      foreach ($columns as $as => $column) {

            $this->columns[] = $column;

      }

      return $this;
  }

  public function selectRaw($column){

      $this->bindings['select'] = [];
      $columns = is_array($column) ? $column : func_get_args();

      foreach ($columns as $as => $column) {

          $this->columns[] = $column;

      }

      return $this;

  }

  public function appendLimit($offset_and_limit){
      $this->limit = 'LIMIT '.$offset_and_limit;
      return $this;
  }

  //execute a query as a select statemtn
   public function get(){
     if(is_null($this->columns)) $this->columns = ['*'];
     $select_statement = $this->grammer->compileSelect($this);
     $result = $this->connection->get($select_statement);

     if(!empty($this->model)){

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

   public function limit($value)
   {

       if ($value >= 0) {
           $this->limit = "LIMIT $value";
       }

       return $this;
   }

   public function first(){
      return  $this->limit(1)->get()[0];
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

  private function buildDelete(){

  }
  public function groupBy(...$groups)
  {

      foreach ($groups as $group) {

          $this->groups = array_merge(
              (array) $this->groups,
              $groups
          );
      }

      return $this;
  }


  public function table($table){
    $table = $table[0];
    $newBuilder = new Builder();
    $newBuilder->from = $table;
    return $newBuilder;
  }

  public function getGrammer(){
    return $this->grammer;
  }
  public function getConnection(){
      return $this->connection;
  }

  public function leftJoin($table, $first, $operator = null, $second = null)
  {
      return $this->join($table, $first, $operator, $second, 'left');
  }

  public function join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false){

    $join = new JoinClause($this, $table,$type);
    $method = $where ? 'where' : 'on';

    $this->joins[] = $join->$method($first, $operator, $second);

     return $this;
  }

  public function find($value){

     return $this->where($this->model->primary_key,'=', $value)->get();
  }

  //add a where clause comparing two columns to the query..
  public function whereColumn($first, $operator = null, $second = null, $boolean = 'and')
  {
      $type = 'Column';

      $this->wheres[] = compact(
          'type', 'first', 'operator', 'second', 'boolean'
      );

      return $this;
  }


}
?>
