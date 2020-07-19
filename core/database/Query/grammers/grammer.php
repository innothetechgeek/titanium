<?
class Grammer{
   //select
    public function compileInsert(Builder $quer_builder,$values){

       $table = $quer_builder->from;

        $columns = array_keys($values);
        $values = "($values)";

        return "insert into $table ($columns) values $values";
    }

    public function constructInsertValues($values){
      $values = "";
      foreach ($values as $column => $value) {
        // code...
        $values .= "$value,";

      }
      return rtrim($values,',');
    }

   //delete

   //update

}
?>
