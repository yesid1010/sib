<?php

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

Route::group(['middleware' => 'admin'], function () {
    // rutas de productos
    Route::resource('products', 'ProductController');
    Route::any('/add/product','ProductController@AddProduct')->name('addproduct');
    // rutas de categorías
    Route::resource('categories', 'CategoryController');
    // rutas de bares
    Route::resource('pubs', 'PubController');
    // rutas de stock
    Route::resource('stocks', 'StockController');
});

Route::group(['middleware' => ['superadmin']], function () {
    // rutas de roles
    Route::resource('roles', 'RoleController');
    // rutas de usuario
    Route::resource('users', 'UserController');
    Route::post('/users/password','UserController@addPassword')->name('password');
});

Route::post('/users/updatepass','UserController@updatePassword')->name('updatepass');

// ruta para el perfil de un usuario
Route::get('profile','UserController@profile')->name('profile');

// detalles
Route::get('detail','StockController@detail')->name('detail');
Route::any('/edit/editdetail','StockController@EditDetail')->name('editdetail');
Route::any('/edit/editdetail','StockController@EditDetail')->name('editdetail');
//  addproductstock
Route::post('addproductstock','StockController@addproduct')->name('addproductst');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



