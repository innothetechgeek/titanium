<?php
namespace core\support\fecade;
use  core\support\fecade\Fecade;
use core\database\query\Builder;

class DB extends Fecade{

  public static function getFecadeAccessor(){
      return 'core\database\query\Builder';
  }
}
