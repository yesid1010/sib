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
    Route::post('deleted','ProductController@destroy')->name('destroys');
    // rutas de categorías
    Route::resource('categories', 'CategoryController');
    Route::post('deletedcategories','CategoryController@destroy')->name('destroycategories');
    // rutas de bares
    Route::resource('pubs', 'PubController');
    // rutas de stock
    Route::resource('stocks', 'StockController');
    // detalles de stock ideales
    Route::get('detailstock','StockController@detailStock')->name('detail');
    Route::any('/edit/editdetail','StockController@EditDetail')->name('editdetail');
    //  addproductstock
    Route::post('addproductstock','StockController@addproduct')->name('addproductst');

    //ORDENES
    Route::resource('orders', 'OrderController');
    Route::get('detailorden','OrderController@DetailOrden')->name('ordendetail');
    Route::post('addproductorder','OrderController@Addproduct')->name('addproductorder');
    Route::any('/edit/editorder','OrderController@EditDetailOrder')->name('editorder');
    Route::get('status/{id}','OrderController@Status')->name('status');

});

Route::group(['middleware' => ['superadmin']], function () {
    // rutas de roles
    Route::resource('roles', 'RoleController');
    Route::post('deletedrole','RoleController@destroy')->name('destroyrole');
    // rutas de usuario
    Route::resource('users', 'UserController');
    Route::post('/users/password','UserController@addPassword')->name('password');

    Route::get('statususers/{id}','UserController@State')->name('statuser');

    Route::post('deleteduser','UserController@destroy')->name('destroyuser');


});

Route::post('/users/updatepass','UserController@updatePassword')->name('updatepass');

// ruta para el perfil de un usuario
Route::get('profile','UserController@profile')->name('profile');




Auth::routes();




// Route::get('/home', 'HomeController@index')->name('home');



