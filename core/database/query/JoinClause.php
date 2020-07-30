<?php
namespace core\database\query;
use core\database\query\Builder;


class JoinClause extends Builder{

  public $type;
  public $table;

  public $grammer,$connection,$query_builder;

  public function __construct(Builder $query_builder,$table,$type){

    $this->type = $type;
    $this->table = $table;
    $this->grammer =  $query_builder->getGrammer();
    $this->connection = $query_builder->getConnection();

  }
  public function on($first, $operator = null, $second = null, $boolean = 'and')
  {

      return $this->whereColumn($first, $operator, $second, $boolean);
      return $this;
  }

}
