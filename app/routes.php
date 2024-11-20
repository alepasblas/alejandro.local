<?php
namespace alejandro\app;

$router->get ('', 'PagesController@index');
$router->get ('about', 'PagesController@about');
$router->get ('asociados', 'AsociadosController@index', 'ROLE_USER');
$router->get ('blog', 'PagesController@blog');
$router->get ('contact', 'ContactController@index');
$router->get ('galeria', 'GaleriaController@index', 'ROLE_USER');
$router->post('galeria/nueva', 'GaleriaController@nueva', 'ROLE_ADMIN');
$router->get ('post', 'PagesController@post');
$router->post ('asociados/nueva', 'AsociadosController@nueva', 'ROLE_ADMIN');
$router->get ('galeria/:id', 'GaleriaController@show', 'ROLE_USER');
$router->get ('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checkLogin');
$router->get ('logout', 'AuthController@logout');
$router->get ('registro', 'AuthController@registro');
$router->post('check-register', 'AuthController@checkRegistro');
