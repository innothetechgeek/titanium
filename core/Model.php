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

    public function __construct($table){
        $this->db = DB::getInstance();
        $this->table = $table;
        $this->setTableColumns();
        $this->model_name = str_replace(' ','',ucwords(str_replace('_',' ',$this->table)));
    }

    public function setTableColumns(){
        $columns = $this->get_columns();
        foreach ($columns as $column){
            $column_name = $column->field;
            $this->column_names[] = $column_name;
            $this->column_name = null;
        }
    }

    public function get_columns(){
        return $this->db->getColumns($this->table);
    }

    public function find($params = []){
        $results = [];
        $resultQuery = $this->db->find($this->table,$params);
        foreach($resultQuery as $result){
            $obj = new $this->model_name($this->table);
            $this->populate_object_data($result);
            $results = $obj;
        }
        return $results;
    }
    public function find_first($params){
        $resultQuery = $this->db->first($this->table,$params);
        $result = new $this->model_name($this->table);
        $result->populate_object_data($resultQuery);
    }

    public function find_by_id($id){

        return $this->find_first(['condition'=>"id=?","bind"=>$id]);

    }

    public function populate_object_data($result){
        foreach($result as $key => $val){
            $this->$key = $val;
        }
    }

}