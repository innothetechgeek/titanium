<?php
class Grammer{

    protected $selectComponents = [
        'aggregate',
        'columns',
        'from',
        'joins',
        'wheres',
        'groups',
        'havings',
        'orders',
        'limit',
        'offset',
        'lock',
    ];

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
            $value = empty($value) ? "' '" : "'$value'";
            $insert_values .= "$value,";

        }
        dnd(rtrim($insert_values,','));
        return rtrim($insert_values,',');

    }

   //delete

   //update

   //compile selector
   public function compileSelect(Builder $query_builder){


   }

   public function compileQueryComponents(Builder $query_builder){

      foreach($this->selectComponents as $component){
        $sql = [];

        foreach ($this->selectComponents as $component) {
            if (isset($query_builder->$component)) {
                $method = 'compile'.ucfirst($component);

                $sql[$component] = $this->$method($query_builder, $query_builder->$component);
            }
        }

        return $sql;
      }
   }

}
?>
