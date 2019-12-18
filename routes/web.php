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
    return view('index');
});


// rutas de productos
Route::resource('products', 'ProductController');
Route::post('/add/product','ProductController@AddProduct')->name('addproduct');

// rutas de categorías
Route::resource('categories', 'CategoryController');

// rutas de bares
Route::resource('pubs', 'PubController');

// rutas de roles
Route::resource('roles', 'RoleController');

// rutas de usuario
Route::resource('users', 'UserController');
Route::post('/users/password','UserController@addPassword')->name('password');
Route::post('/users/updatepass','UserController@updatePassword')->name('updatepass');

// ruta para el perfil de un usuario
Route::get('profile','UserController@profile')->name('profile');
