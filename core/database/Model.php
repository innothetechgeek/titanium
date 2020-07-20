<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-05
 * Time: 21:18
 */

class Model
{
    protected $connection,$query_builder,$model_name, $soft_delete = false, $column_names = [];
    public $id,$table;

    public function __construct($table){
        $this->db = DB::getInstance();
        $this->query_builder = new Builder();
        $this->table = $table;
        //find first
        $this->model_name = str_replace(' ','',ucwords(str_replace('_',' ',$this->table)));
        $this->query_builder->from = $this->table;
          $this->setTableColumns();
          $this->query_builder->setModel($this);

    }

    public function get_fields(){

        $fields = [];
        foreach ($this->column_names as $column){
            $fields[$column] = $this->$column;
        }
        return $fields;

    }

    public function setTableColumns(){

        $columns = $this->get_columns();
        foreach ($columns as $column){
            $column_name = $column;
            $this->column_names[] = $column_name;
            $this->$column_name = null;
        }

    }

    public function get_columns(){

        return $this->query_builder->getTableColumns($this->table);

    }

    public function find($params = []){

        $results = [];
        $resultQuery = $this->db->find($this->table,$params);
        foreach($resultQuery as $result){
            $obj = new $this->model_name($this->table);
            $obj->populate_object_data($result);
            $results = $obj;
        }
        return $results;

    }
    public function findAll($params=[]){

        return $this->db->find($this->table,$params);

    }

    public function select($sql){
        $queryResult = $this->db->select($sql);

        $resultArr = [];
        $fildsArr = [];
        if($queryResult){

            foreach ($queryResult as $field => $obj) {
                foreach ($obj as $field => $value) {
                    $fildsArr[$field] = $value;
                }
                array_push($resultArr,$fildsArr);

            }
        }
        return $resultArr;
    }

    public function find_first($params){


       $resultQuery = $this->db->findFirst($this->table,$params);
        if($resultQuery) {
            foreach ($resultQuery as $result) {

                $obj = new $this->model_name();

                $obj->populate_object_data($resultQuery);

            }
           return $obj;
        }

    }

    public function find_by_id($id){

        $obj =  $this->find_first(['condition'=>"id=?","bind"=>$id]);


    }

    public function insert($fields){

        if(empty($fields)) return false;
        return $this->query_builder->insert($this->table);


    }

    public function update($id,$fields){
        if(empty($fields) || $id == '')  return false;
        return $this->db->insert($this->table,$id, $fields);

    }

    public function save(){

        $fields_ = [];
       //dnd($this->column_names);
        foreach ($this->column_names as $column){
            $fields_[$column] = $this->$column;
        }

        //determine whether to updae or insert
        if(property_exists($this,'id') && $this->id != ''){
            return $this->update($this->id,$fields);
        }else{
           $this->insert($fields_);
           $this->id = $this->db->last_insert_id;
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

}
