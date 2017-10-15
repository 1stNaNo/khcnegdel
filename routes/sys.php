<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/order', 'Sys\OrderController@index');
Route::any('/orderregister', 'Sys\OrderController@indexOrderRegister');
Route::post('/orderconf', 'Sys\OrderController@indexOrderConf');
Route::post('/order/save', 'Sys\OrderController@ordersave');
Route::get('/order/data', 'Sys\OrderController@orderdata');
Route::post('/order/opdata', 'Sys\OrderController@opdata');
Route::post('/order/opsplitdata', 'Sys\OrderController@opsplitdata');
Route::post('/order/orderedit', 'Sys\OrderController@orderedit');
Route::post('/order/ordereditsave', 'Sys\OrderController@ordereditsave');
Route::post('/order/checkInterval', 'Sys\OrderController@checkInterval');

Route::post('/order/producttypes', 'Sys\OrderController@producttypes');
Route::post('/order/popupamount', 'Sys\OrderController@popup');
Route::post('/order/delete', 'Sys\OrderController@delete');
Route::post('/order/reload', 'Sys\OrderController@reload');
Route::post('/order/confirm', 'Sys\OrderController@confirm');
Route::post('/order/confirmindex', 'Sys\OrderController@confirmindex');

Route::get('/order/report', 'Sys\OrderController@reportorder');
// ---- END ORDER -------------


// ---- BEGIN INTERVAL -------------

Route::get('/interval', 'Sys\IntervalController@index');
Route::post('/interval/save', 'Sys\IntervalController@save');

// ---- END INTERVAL -------------

// // ---- BEGIN ADDRESS -------------

Route::get('/address', 'Sys\AddressController@index');
Route::post('/address/save', 'Sys\AddressController@save');
Route::get('/address/tree', 'Sys\AddressController@tree');
Route::get('/address/tree/node', 'Sys\AddressController@treeNode');
Route::get('/address/list', 'Sys\AddressController@datalist');

// ---- END INTERVAL -------------

// // ---- BEGIN CLIENTS USERS -------------

Route::get('/clients', 'Sys\ClientsController@index');
Route::get('/clients/list', 'Sys\ClientsController@datalist');
Route::post('/clients/edit', 'Sys\ClientsController@edit');
Route::post('/clients/save', 'Sys\ClientsController@save');
Route::post('/clients/remove', 'Sys\ClientsController@remove');

// ---- END CLIENTS USERS -------------


