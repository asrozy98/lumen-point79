<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () {
    return redirect('nasabah');
});

$router->get('nasabah', ['uses' => 'NasabahController@index']);
$router->post('nasabah', ['uses' => 'NasabahController@store']);

$router->get('transaksi', ['uses' => 'TransaksiController@index']);
$router->post('transaksi', ['uses' => 'TransaksiController@store']);

$router->get('poin', ['uses' => 'TransaksiController@poin']);
$router->get('laporan', ['uses' => 'TransaksiController@laporan']);
