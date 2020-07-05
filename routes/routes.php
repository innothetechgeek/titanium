<?php

Router::get('contact',function(){

});

Router::get('index','home@index');

Router::get('','home@index');

Router::get('page_not_found','home@page_not_found');

Router::get('user/register','user@register');

Router::get('user/login','user@login');

Router::get('movies/add','movies@add');

Router::get('movies/view','movies@view');

Router::get('user/logout','user@logout');



?>
