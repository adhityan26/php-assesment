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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'soldier', 'namespace' => 'Soldier'], function () use ($router) {
    $router->get('/', 'MagazineController@index');
    $router->get('/testMagazine', 'MagazineController@testMagazine');
    $router->post('/initMagazine', 'MagazineController@initMagazine');
    $router->put('/putAmmo', 'MagazineController@putAmmo');
    $router->delete('/clearMagazine', 'MagazineController@clearMagazine');
});

$router->group(['prefix' => 'shop', 'namespace' => 'Shop'], function () use ($router) {
    $router->get('/', 'ProductController@index');
    $router->post('/addProduct', 'ProductController@addProduct');
    $router->put('/reduceQty', 'ProductController@reduceQty');
    $router->delete('/clearProduct', 'ProductController@clearProduct');
});
