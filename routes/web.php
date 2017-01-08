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

Route::get('/', function () {
    return view('welcome');
});


// Paginas
Route::resource('/admin/paginas', 'PageController');

//Blog
Route::resource('/admin/blog', 'BlogController');
Route::post('/admin/blog/editcats', 'BlogController@quickeditcategories');
Route::resource('/admin/categorias', 'CategoryController');

// Portfolio
Route::resource('/admin/portfolio', 'ProjectController');
Route::post('/admin/portfolio/editcats', 'ProjectController@quickeditcategories');
Route::resource('/admin/categorias-portfolio', 'ProjectCategoryController');
Route::post('admin/project/uploadimage', 'ProjectController@uploadimage');

// Imagenes
Route::resource('/admin/media', 'MediaController');

Route::post('/admin/upload', 'MediaController@uploadimages');
