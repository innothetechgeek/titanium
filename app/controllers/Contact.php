<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-11
 * Time: 23:28
 */

class Contact  extends Controller
{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
    }

    public  function list_all(){
      return('contact/list_all');
    }


}