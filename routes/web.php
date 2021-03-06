<?php

Route::get('/', function () {
    if(Auth::check()){
        if(Auth::user()->role_id != 1){
            return redirect('home');
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
    Route::get('pdfproducts','ProductController@pdf')->name('pdfproducts');
    Route::post('deleted','ProductController@destroy')->name('destroyproduct')->middleware('password.confirm');
    // rutas de categorías
    Route::resource('categories', 'CategoryController');
    Route::post('deletedcategories','CategoryController@destroy')->name('destroycategories')->middleware('password.confirm');
    // rutas de bares
    Route::resource('pubs', 'PubController');
    Route::post('deletedpub','PubController@destroy')->name('destroypub')->middleware('password.confirm');
    Route::get('orderspubs','PubController@OrderPub')->name('orderspub');

    // rutas de stock
    Route::resource('stocks', 'StockController');
    // detalles de stock ideales
    Route::get('detailstock','StockController@detailStock')->name('detail');
    Route::any('/edit/editdetail','StockController@EditDetail')->name('editdetail');
    //  addproductstock
    Route::post('addproductstock','StockController@addproduct')->name('addproductst');
    Route::post('deletedstock','StockController@destroy')->name('destroystock')->middleware('password.confirm');
    Route::post('deletedproductstock','StockController@destroyproduct')->name('destroyproductstock')->middleware('password.confirm');

    //ORDENES
    Route::resource('orders', 'OrderController');
    Route::get('detailorden','OrderController@DetailOrden')->name('ordendetail');
    Route::post('addproductorder','OrderController@Addproduct')->name('addproductorder');
    Route::any('/edit/editorder','OrderController@EditDetailOrder')->name('editorder');
    Route::get('status/{id}','OrderController@Status')->name('status');
    Route::post('deletedproductorder','OrderController@destroy')->name('destroyorderp')->middleware('password.confirm');



    //historial de usuarios barmans
    Route::get('ordersbarmans','OrderController@OrderBarman')->name('ordersbarman');


    Route::get('pdf/{id}','OrderController@pdf')->name('pdf');

    Route::get('usersb','UserController@barmans')->name('usersb');

    Route::resource('kardexs', 'KardexController');
    Route::get('kardexshow','KardexController@shows')->name('kardexshow');
    Route::get('distribution','KardexController@distribution')->name('distribution');
    Route::get('pdfkardex/{id}','KardexController@pdf')->name('pdfkardex');

    Route::resource('home', 'HomeController');
});

Route::group(['middleware' => ['superadmin']], function () {
    // rutas de roles
    Route::resource('roles', 'RoleController');
    Route::post('deletedrole','RoleController@destroy')->name('destroyrole')->middleware('password.confirm');
    // rutas de usuario
    Route::resource('users', 'UserController');
    Route::post('/users/password','UserController@addPassword')->name('password');

    Route::get('statususers/{id}','UserController@State')->name('statuser');

    Route::post('deleteduser','UserController@destroy')->name('destroyuser')->middleware('password.confirm');


});

Route::post('/users/updatepass','UserController@updatePassword')->name('updatepass');

// ruta para el perfil de un usuario
Route::get('profile','UserController@profile')->name('profile');




Auth::routes();




// Route::get('/home', 'HomeController@index')->name('home');



