<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-05
 * Time: 21:18
 */
namespace core\database;
use core\DB;
use core\database\query\Builder;
class Model
{
    protected $connection,$table,$query_builder,$model_name, $soft_delete = false, $column_names = [];
    public $id;

    public function __construct(){

        $this->query_builder = new Builder();
        $this->model_name = str_replace(' ','',ucwords(str_replace('_',' ',$this->table)));
        $this->query_builder->from = $this->table;
        $this->query_builder->addBinding('from',$this->table);
        $this->query_builder->setModel($this);

    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {

      $object = new Builder();
      $object->setModel($this);

      $object = $object->{$method}(...$parameters);
      return $object;
    }

    /**
     * Handle dynamic static method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    public function get_fields(){

      $column_names = $this->get_columns();
        $fields = [];
       //dnd($this->column_names);
        foreach ($column_names as $column){
          if(property_exists($this,$column)){
              $fields[$column] = $this->$column;
          }
        }
        return $fields;

    }

    public function fillWithAtrributes($attributes){

      //  $columns = $this->get_columns();
        foreach ($attributes as $column){
            $column_name = $column;
            $this->column_names[] = $column_name;
            $this->$column_name = null;
        }

    }

    public function get_columns(){

        return $this->query_builder->getTableColumns($this->table);

    }

    public function insert($fields){

        if(empty($fields)) return false;
        return $this->query_builder->insert($this->table);


    }

    public function getTable(){
      return $this->table;
    }

    public function update($id,$fields){
        if(empty($fields) || $id == '')  return false;
        return $this->db->insert($this->table,$id, $fields);

    }

    public function save(){

        $fields = $this->get_fields();
        //determine whether to updae or insert
        if(property_exists($this,'id') && $this->id != ''){
            return $this->update($this->id,$fields);
        }else{
           $this->insert($fields);
          return  $this->id;

        }
    }

    public function data(){
        $data = new stdClass();
        foreach ($this->column_names as $column){
            $data->column = $this->column;
        }
        return $data;
    }

    public function assign($params){

        if(!empty($params)){
            foreach($params as $key => $val){
                if(in_array($key,$this->column_names)){
                    $this->$key = sanitize($val);
                }
            }
            return true;
        }
        return false;

    }
    public function delete($id = ''){

        if($id == '' && $this->id == '') return false;
        $id ($id == '') ? $this->id : $id;
        if($this->soft_delete){
            return $this->update(['deted' => 1]);
        }

        $this->delete->db->delete($this->table,$id);
    }
    public function query($sql,$bind){
        return $this->db->query($sql,$bind);
    }
    public function populate_object_data($result){
        foreach($result as $key => $val){
         //   dnd($key);
            $this->$key = $val;
        }
    }

    public static function all(){
        return (new static)->new_query_builder()->get();
    }

    public function new_query_builder(){

        return $this->query_builder;

    }

}
