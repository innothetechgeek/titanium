<?php
class Grammer{
   //select
    public function compileInsert(Builder $quer_builder,$values){
      dnd($values);

       $table = $quer_builder->from;

        $columns = implode(array_keys($values),",");
        $insert_values = "(".$this->constructInsertValues($values).")";


        return "insert into $table ($columns) values $insert_values";
    }

    public function constructInsertValues($values){
      $values['usr_id'] = rand();

      $insert_values = "";
      foreach ($values as $column => $value) {
        $value = empty($value) ? "'hello'" : $value;
        // code...
        $insert_values .= "$value,";

      }
      dnd(rtrim($insert_values,','));
      return rtrim($insert_values,',');
    }

   //delete

   //update

}
?>
