<?php
class Grammer{
   //select
    public function compileInsert(Builder $quer_builder,$values){


       $table = $quer_builder->from;
       $columns = array_filter($values);


        $columns = implode(array_keys($columns),",");
           dnd($columns);
        $insert_values = "(".$this->constructInsertValues($values).")";


        return "insert into $table ($columns) values $insert_values";
    }

    public function constructInsertValues($values){
        $values = array_filter($values);
        $insert_values = "";
        dnd($values);
        foreach ($values as $column => $value) {
            $insert_values .= "'$value',";
        }
        dnd($insert_values);
        return rtrim($insert_values,',');

    }

   //delete

   //update

}
?>
