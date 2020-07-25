<?php
namespace core\support\fecade;
use core\database\query\Builder;

class Fecade{
  public static function __callStatic($name,$args){
    dnd(static::getFecadeAccessor());
      return self::resolve_instance(static::getFecadeAccessor())->$name();
  }

  public static function getFecadeAccessor(){

  }

  private static function resolve_instance($fecade){
      
      return new $fecade();
  }

}
?>
