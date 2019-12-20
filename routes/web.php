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

/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/', function () {
    if(Auth::check()){
        if(Auth::user()->role_id != 1){
            return redirect('products');
        }else{
            return redirect('users');
        }
    }else{
        return view('auth.login');
    }
});


// rutas de productos
Route::resource('products', 'ProductController')->middleware('admin');
Route::any('/add/product','ProductController@AddProduct')->name('addproduct');

// rutas de categorías
Route::resource('categories', 'CategoryController')->middleware('admin');

// rutas de bares
Route::resource('pubs', 'PubController')->middleware('admin');

// rutas de roles
Route::resource('roles', 'RoleController')->middleware('superadmin');

// rutas de usuario
Route::resource('users', 'UserController')->middleware('superadmin');
Route::post('/users/password','UserController@addPassword')->name('password')->middleware('superadmin');
Route::post('/users/updatepass','UserController@updatePassword')->name('updatepass')->middleware('superadmin');

// ruta para el perfil de un usuario
Route::get('profile','UserController@profile')->name('profile');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
