<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2019-03-31
 * Time: 01:57
 */
namespace core;
class Application
{
    public function __construct(){
        $this->_set_reporting();
        $this->_unregister_globals();

    }

    /**
     *
     */
    private function _set_reporting(){

        if(DEBUG) {
            error_reporting(E_ALL);
            ini_set('display_errors',1);
        }else{
            error_reporting(E_ALL);
            ini_set('display_errors',0);
            ini_set('log_errors',1);
            ini_set('log_errors',ROOT . DS . 'temp' . DS .'logs' . DS . 'errors.log');
        }

    }

    private function _unregister_globals(){

        if(ini_get('register_globals')){
            $globalsArr = ['_SESSION', '_COOKIE','_POST','_GET','REQUEST','_SERVER','_ENV','_FILES'];
            foreach ($globalsArr as $g){
                foreach ($GLOBALS[$g] as $k => $v){
                    if($GLOBALS[$g] == $v){
                        unset($GLOBALS[$k]);
                    }
                }
            }
        }

    }
}
