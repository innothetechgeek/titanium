<?php
namespace core\support\fecade;
use  core\support\fecade\Fecade;

class DB extends Fecade{

  public static function getFecadeAccessor(){
      return 'core\database\query\Builder';
  }
}
