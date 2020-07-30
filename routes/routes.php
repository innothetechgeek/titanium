<?php


require_once 'core\Router.php';
use core\Router;

Router::get('contact',function(){

});

Router::get('index','home@index');

Router::get('','home@index');

Router::get('page-not-found','home@page_not_found');

Router::get('user/register','user@register');
Router::post('register','user@registerUser');

Router::get('user/login','user@login');

Router::get('movies/add','movies@add');

Router::get('movies','movies@view');

Router::get('user/logout','user@logout');



?>
