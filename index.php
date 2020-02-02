<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-28
 * Time: 21:37
 */
session_start();
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));
$url  = isset($_SERVER['PATH_INFO']) ? explode('/',ltrim($_SERVER['PATH_INFO'],'/')) : [];
require_once(ROOT . DS . 'core' . DS . 'bootstrap.php');

//$db = DB::getInstance();

