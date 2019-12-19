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
Route::resource('products', 'ProductController');
Route::post('/add/product','ProductController@AddProduct')->name('addproduct');

// rutas de categorías
Route::resource('categories', 'CategoryController')->middleware('auth');

// rutas de bares
Route::resource('pubs', 'PubController')->middleware('auth');

// rutas de roles
Route::resource('roles', 'RoleController')->middleware('auth');

// rutas de usuario
Route::resource('users', 'UserController');
Route::post('/users/password','UserController@addPassword')->name('password');
Route::post('/users/updatepass','UserController@updatePassword')->name('updatepass');

// ruta para el perfil de un usuario
Route::get('profile','UserController@profile')->name('profile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
