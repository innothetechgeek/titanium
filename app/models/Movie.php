<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-17
 * Time: 00:36
 */

class Movie extends Model
{
    public function __construct()
    {
        $table = 'movie';
        parent::__construct($table);
    }
}