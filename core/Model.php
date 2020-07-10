<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-02-05
 * Time: 21:18
 */

class Model
{
    protected $db, $table,$model_name, $soft_delete = false, $column_names = [];
    public $id;

    public function __construct($table){
        $this->db = DB::getInstance();
        $this->table = $table;
        $this->setTableColumns();

        //find first
        $this->model_name = str_replace(' ','',ucwords(str_replace('_',' ',$this->table)));
    }

    public function setTableColumns(){
        $columns = $this->get_columns();
        foreach ($columns as $column){
            $column_name = $column->Field;
            $this->column_names[] = $column_name;
            $this->$column_name = null;
          //  $person->user =
        }
    }

    public function get_columns(){

        return $this->db->getColumns($this->table);

    }

    public function find($params = []){
        $results = [];
        $resultQuery = $this->db->find($this->table,$params);
       // dnd($resultQuery);
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
        return $this->db->insert($this->table,$fields);

    }

    public function update($id,$fields){
        if(empty($fields) || $id == '')  return false;
        return $this->db->insert($this->table,$id, $fields);

    }

    public function save(){
        $fields = [];
        foreach ($this->column_names as $column){
            $fields[$column] = $this->$column;
        }
        //determine whether to updae or insert
        if(property_exists($this,'id') && $this->id =''){
            return $this->update($this->id,$fields);
        }else{
          $this->insert($fields);
          $this->id = $this->db->last_insert_id;
          return $this;

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