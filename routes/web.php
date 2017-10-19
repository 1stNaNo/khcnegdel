<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->middleware('lang');

Route::get('/category/{id}', 'Web\PostController@postbycategory')->middleware('lang');
Route::get('/post/{id}', 'Web\PostController@post')->middleware('lang');
Route::post('/savecomment', 'Web\PostController@savecomment');
Route::post('/submitpoll', 'Web\PostController@submitpoll');

Route::get('/changeLang/{locale}', function ($locale) {
    App::setLocale(Session::put('lang',$locale));
    return response()->json(['status' => 'true']);
})->middleware('lang');


// ****************** WEB ROUTES *************************




// ****************** ADMIN ROUTES *************************

Auth::routes();


Route::get('/admin/category', 'Admin\CategoryController@index');
Route::post('/admin/category/index', 'Admin\CategoryController@indexA');
Route::post('/admin/category/save', 'Admin\CategoryController@save');
Route::post('/admin/category/remove', 'Admin\CategoryController@remove');

Route::get('/admin/datatables.data', 'Admin\CategoryController@anyData');


// ---- END SECTION CATEGORY -------------

// ---- BEGIN SECTION ROLE -------------

Route::get('/admin/role', 'Role\RoleController@index');
Route::post('/admin/role/index', 'Role\RoleController@update');
Route::get('/admin/role/data', 'Role\RoleController@data');
Route::post('/admin/role/update', 'Role\RoleController@update');
Route::post('/admin/role/save', 'Role\RoleController@save');
Route::post('/admin/role/remove', 'Role\RoleController@remove');


// ---- END SECTION ROLE -------------

// WebLinks
Route::get('/admin/weblink', 'Admin\WebLinkController@index');
Route::get('/admin/weblinklist', 'Admin\WebLinkController@weblinkList');
Route::post('/admin/weblinkregister', 'Admin\WebLinkController@register');
Route::post('/admin/weblinksave', 'Admin\WebLinkController@save');
Route::post('/admin/weblinkremove', 'Admin\WebLinkController@delete');

Route::get('/admin/decision', 'Admin\DecisionController@index');
Route::get('/admin/decisionlist', 'Admin\DecisionController@complaintsList');
Route::post('/admin/decisionregister', 'Admin\DecisionController@decisionregister');
Route::post('/admin/decisionsave', 'Admin\DecisionController@save');
// POLL
Route::get('/admin/poll', 'Admin\PollController@index');
Route::get('/admin/pollList', 'Admin\PollController@pollsList');
Route::post('/admin/pollregister', 'Admin\PollController@pollregister');
Route::post('/admin/pollsave', 'Admin\PollController@save');
Route::post('/admin/activepoll', 'Admin\PollController@activepoll');
Route::post('/admin/inactivepoll', 'Admin\PollController@inactivepoll');

// ---- BEGIN BANNER UPLOAD -------------

Route::get('/admin/banner', 'Admin\BannerController@index');
Route::post('/admin/banner/index', 'Admin\BannerController@indexA');
Route::post('/admin/banner/save', 'Admin\BannerController@save');
Route::post('/admin/banner/remove', 'Admin\BannerController@remove');

Route::get('/admin/banner/data', 'Admin\BannerController@anyData');

// ---- END BANNER UPLOAD -------------

// ---- BEGIN SECTION UPLOAD -------------

Route::get('/admin/upload/{upload_type}', 'Admin\FileUploadController@index');
Route::post('/admin/upload/do', 'Admin\FileUploadController@upload');
Route::post('/admin/upload/thumbnail', 'Admin\FileUploadController@uploadThumbnail');
Route::post('/admin/upload/banner', 'Admin\FileUploadController@uploadBanner');

Route::any('/admin/gallery/{gType}', 'Admin\FileUploadController@gallery');

// ---- END SECTION UPLOAD -------------

// ---- END SECTION NEWS -------------

Route::get('/admin/news', 'Admin\NewsController@index');
Route::post('/admin/news/index', 'Admin\NewsController@indexA');
Route::post('/admin/news/save', 'Admin\NewsController@save');
Route::post('/admin/news/remove', 'Admin\NewsController@remove');

Route::get('/admin/news/data', 'Admin\NewsController@anyData');

// ---- END SECTION NEWS -------------

// ---- END SHORTER NEWS -------------

Route::get('/admin/shorter', 'Admin\ShorterController@index');
Route::post('/admin/shorter/index', 'Admin\ShorterController@indexA');
Route::post('/admin/shorter/save', 'Admin\ShorterController@save');
Route::post('/admin/shorter/remove', 'Admin\ShorterController@remove');

Route::get('/admin/shorter/data', 'Admin\ShorterController@anyData');

// ---- END SHORTER NEWS -------------

// NEWSCAT
Route::get('/admin/newscat', 'Admin\NewsCatController@index');
Route::post('/admin/savenewscat', 'Admin\NewsCatController@save');

// ---- BEGIN FILE TYPE CATEGORY -------------

Route::get('/admin/filetype', 'Admin\FileTypeController@index');
Route::post('/admin/filetype/index', 'Admin\FileTypeController@indexA');
Route::post('/admin/filetype/save', 'Admin\FileTypeController@save');
Route::post('/admin/filetype/remove', 'Admin\FileTypeController@remove');

Route::get('/admin/filetype/data', 'Admin\FileTypeController@anyData');


// ---- END FILE TYPE CATEGORY -------------

// ---- BEGIN FILE -------------

Route::get('/admin/file', 'Admin\UFileController@index');
Route::post('/admin/file/index', 'Admin\UFileController@indexA');
Route::post('/admin/file/save', 'Admin\UFileController@save');
Route::post('/admin/file/remove', 'Admin\UFileController@remove');

Route::get('/admin/file/data', 'Admin\UFileController@anyData');


// ---- END FILE -------------

// ---- BEGIN EXTERNAL -------------

Route::get('/admin/external', 'Admin\ExternalController@index');
Route::post('/admin/external/index', 'Admin\ExternalController@indexA');
Route::post('/admin/external/save', 'Admin\ExternalController@save');
Route::post('/admin/external/remove', 'Admin\ExternalController@remove');

Route::get('/admin/external/data', 'Admin\ExternalController@anyData');


// ---- END EXTERNAL -------------

// ---- BEGIN FILE LINKS -------------

Route::get('/admin/links', 'Admin\LinksController@index');
Route::post('/admin/linkssave', 'Admin\LinksController@save');


// ---- END FILE LINKS -------------

// ---- BEGIN TITLE -------------

Route::get('/admin/title', 'Admin\TitleController@index');
Route::post('/admin/titlesave', 'Admin\TitleController@save');

// ---- END TITLE -------------

// ---- BEGIN CONTACT -------------

Route::get('/admin/contact', 'Admin\ContactController@index');
Route::post('/admin/contact/save', 'Admin\ContactController@save');

// ---- END CONTACT -------------

// ---- BEGIN PASSWORD -------------

Route::get('/admin/password', 'Admin\UsersController@passwordReset');
Route::post('/admin/password/save', 'Admin\UsersController@passwordSave');

// ---- END PASSWORD -------------



// ---- BEGIN FILE USERS -------------

Route::get('/admin/users', 'Admin\UsersController@index');
Route::get('/admin/userslist', 'Admin\UsersController@userslist');
Route::post('/admin/newuser', 'Admin\UsersController@indexnewuser');
Route::post('/admin/usersave', 'Admin\UsersController@save');
Route::post('/admin/userremove', 'Admin\UsersController@remove');

// ---- END FILE USERS -------------


// ---- BEGIN MASTER -------------

Route::get('/sys/masters', 'Sys\MastersController@index');
Route::get('/sys/masters/list', 'Sys\MastersController@datalist');
Route::post('/sys/masters/edit', 'Sys\MastersController@edit');
Route::post('/sys/masters/save', 'Sys\MastersController@save');
Route::post('/sys/masters/remove', 'Sys\MastersController@remove');

// ---- END MASTER -------------

// ---- BEGIN PRODUCT -------------

Route::get('/sys/product', 'Sys\ProductController@index');
Route::get('/sys/product/list', 'Sys\ProductController@datalist');
Route::post('/sys/product/edit', 'Sys\ProductController@edit');
Route::post('/sys/product/save', 'Sys\ProductController@save');
Route::post('/sys/product/remove', 'Sys\ProductController@remove');

// ---- END PRODUCT -------------


// ---- BEGIN PRODUCT -------------

Route::get('/sys/product/type', 'Sys\ProductTypeController@index');
Route::get('/sys/product/type/list', 'Sys\ProductTypeController@datalist');
Route::post('/sys/product/type/edit', 'Sys\ProductTypeController@edit');
Route::post('/sys/product/type/save', 'Sys\ProductTypeController@save');
Route::post('/sys/product/type/remove', 'Sys\ProductTypeController@remove');

// ---- END PRODUCT -------------

// ---- BEGIN ORDER -------------




Route::get('/admin/icons', function () {
    return \View::make('admin.icons');
})->middleware('lang')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/admin/home', function () {
    return \View::make('home');
})->middleware('lang')->middleware('auth');

Route::get('/complaints', function(){
  return \View::make('web.complaints');
})->middleware('lang');

Route::post('/svcomplaints', 'Web\ComplaintsController@save')->middleware('lang');

Route::post('/pollInfo', 'Web\ComplaintsController@pollInfo');
Route::any('/sub', 'Sub\SubController@index');
