<?php

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

use Illuminate\Support\Facades\Cache;

$router->get('/', function () use ($router) {
//    phpinfo();
    return $router->app->version();
});

$router->get('/flush', function () use ($router) {
//    phpinfo();
    return Cache::flush();
});

$router->group(['prefix' => 'soldier', 'namespace' => 'Soldier'], function () use ($router) {
    $router->get('/', 'MagazineController@index');
    $router->get('/testMagazine', 'MagazineController@testMagazine');
    $router->post('/initMagazine', 'MagazineController@initMagazine');
    $router->put('/putAmmo', 'MagazineController@putAmmo');
    $router->delete('/clearMagazine', 'MagazineController@clearMagazine');
});

$router->group(['prefix' => 'tennis', 'namespace' => 'Tennis'], function () use ($router) {
    $router->get('/', 'ContainerController@index');
    $router->post('/initContainer', 'ContainerController@initContainer');
    $router->put('/putBall', 'ContainerController@putBall');
    $router->delete('/clearContainer', 'ContainerController@clearContainer');
});

$router->group(['prefix' => 'shop', 'namespace' => 'Shop'], function () use ($router) {
    $router->get('/', 'ProductController@index');
    $router->post('/addProduct', 'ProductController@addProduct');
    $router->put('/reduceQty', 'ProductController@reduceQty');
    $router->delete('/clearProduct', 'ProductController@clearProduct');
});

$router->group(['prefix' => 'game', 'namespace' => 'Game'], function () use ($router) {
    $router->post('/key', 'KeyController@findingKey');
});
