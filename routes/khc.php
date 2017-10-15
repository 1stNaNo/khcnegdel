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
Route::get('/address', 'Sys\AddressController@index');
Route::post('/address/update', 'Sys\AddressController@update');
Route::post('/address/save', 'Sys\AddressController@save');
Route::post('/address/remove', 'Sys\AddressController@remove');
Route::get('/address/tree', 'Sys\AddressController@tree');
Route::get('/address/tree/node', 'Sys\AddressController@treeNode');
Route::get('/address/list', 'Sys\AddressController@datalist');
