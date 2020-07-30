<?php
namespace core\support\fecade;
use core\database\query\Builder;

class Fecade{
  public static function __callStatic($name,$args){
      return self::resolve_instance(static::getFecadeAccessor())->$name($args);
  }

  public static function getFecadeAccessor(){

  }

  private static function resolve_instance($fecade){

      return new $fecade();
  }

}
?>
