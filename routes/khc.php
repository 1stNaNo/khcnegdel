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
Route::any('/address', 'Khc\AddressController@index');
Route::post('/address/update', 'Khc\AddressController@update');
Route::post('/address/save', 'Khc\AddressController@save');
Route::post('/address/remove', 'Khc\AddressController@remove');
Route::get('/address/tree', 'Khc\AddressController@tree');
Route::get('/address/tree/node', 'Khc\AddressController@treeNode');
Route::get('/address/list', 'Khc\AddressController@datalist');
Route::get('/address/get/child', 'Khc\AddressController@getChild');


/* PRODUCT */

Route::get('/product', 'Khc\ProductController@index');
Route::post('/product/update', 'Khc\ProductController@update');
Route::post('/product/save', 'Khc\ProductController@save');
Route::post('/product/remove', 'Khc\ProductController@remove');
Route::get('/product/tree', 'Khc\ProductController@tree');
Route::get('/product/tree/node', 'Khc\ProductController@treeNode');
Route::get('/product/list', 'Khc\ProductController@datalist');
Route::get('/product/get/child', 'Khc\ProductController@getChild');


/* PRODUCT */

Route::get('/unit', 'Khc\UnitController@index');
Route::post('/unit/update', 'Khc\UnitController@update');
Route::post('/unit/save', 'Khc\UnitController@save');
Route::post('/unit/remove', 'Khc\UnitController@remove');
Route::get('/unit/list', 'Khc\UnitController@datalist');


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

Route::get('/supplier', 'Khc\SupplierController@index');
Route::post('/supplier/edit', 'Khc\SupplierController@edit');
Route::post('/supplier/save', 'Khc\SupplierController@save');
Route::post('/supplier/delete', 'Khc\SupplierController@delete');
Route::get('/supplier/data', 'Khc\SupplierController@data');

Route::get('/employer', 'Khc\EmployerController@index');
Route::post('/employer/edit', 'Khc\EmployerController@edit');
Route::post('/employer/save', 'Khc\EmployerController@save');
Route::post('/employer/delete', 'Khc\EmployerController@delete');
Route::get('/employer/data', 'Khc\EmployerController@data');

Route::get('/cost', 'Khc\CostController@index');
Route::post('/cost/edit', 'Khc\CostController@edit');
Route::post('/cost/save', 'Khc\CostController@save');
Route::post('/cost/delete', 'Khc\CostController@delete');
Route::get('/cost/data', 'Khc\CostController@data');

Route::get('/costtemplate', 'Khc\CostTemplateController@index');
Route::post('/costtemplate/edit', 'Khc\CostTemplateController@edit');
Route::post('/costtemplate/save', 'Khc\CostTemplateController@save');
Route::post('/costtemplate/delete', 'Khc\CostTemplateController@delete');
Route::get('/costtemplate/data', 'Khc\CostTemplateController@data');
