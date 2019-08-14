<?php

date_default_timezone_set('America/Sao_Paulo');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', ['as' => 'home','uses' => 'IndexController@index']);
$router->get('/order', ['as' => 'order','uses' => 'IndexController@order']);
$router->get('/random', ['as' => 'random','uses' => 'IndexController@random']);
$router->post('/upload', ['as' => 'upload','uses' => 'IndexController@upload']);
