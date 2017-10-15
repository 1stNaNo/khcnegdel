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
Route::get('/address', 'Khc\AddressController@index');
Route::post('/address/update', 'Khc\AddressController@update');
Route::post('/address/save', 'Khc\AddressController@save');
Route::post('/address/remove', 'Khc\AddressController@remove');
Route::get('/address/tree', 'Khc\AddressController@tree');
Route::get('/address/tree/node', 'Khc\AddressController@treeNode');
Route::get('/address/list', 'Khc\AddressController@datalist');
Route::get('/address/get/child', 'Khc\AddressController@getChild');



/* KHC */

Route::get('/warehouse', 'Khc\WarehouseController@index');
Route::post('/warehouse/edit', 'Khc\WarehouseController@edit');
Route::post('/warehouse/save', 'Khc\WarehouseController@save');
Route::post('/warehouse/delete', 'Khc\WarehouseController@delete');
Route::get('/warehouse/data', 'Khc\WarehouseController@data');

Route::get('/purchaser', 'Khc\PurchaserController@index');
Route::post('/purchaser/edit', 'Khc\PurchaserController@edit');
Route::post('/purchaser/save', 'Khc\PurchaserController@save');
Route::post('/purchaser/delete', 'Khc\PurchaserController@delete');
Route::get('/purchaser/data', 'Khc\PurchaserController@data');

Route::get('/employer', 'Khc\EmployerController@index');
Route::post('/employer/edit', 'Khc\EmployerController@edit');
Route::post('/employer/save', 'Khc\EmployerController@save');
Route::post('/employer/delete', 'Khc\EmployerController@delete');
Route::get('/employer/data', 'Khc\EmployerController@data');
