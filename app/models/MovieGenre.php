<?php
/**
 * Created by PhpStorm.
 * User: KhuselaM
 * Date: 2020-05-17
 * Time: 04:54
 */

class MovieGenre extends Model
{
    public function __construct()
    {
        $table = 'mv_genre';
        parent::__construct($table);
    }
}