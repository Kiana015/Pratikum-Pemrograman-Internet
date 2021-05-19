<?php

use Illuminate\Support\Facades\Route;

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

//halaman utama
Route::get('/', 'UserController@index');

Auth::routes(['verify' => true, 'guest']);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin');

Route::middleware('admin:admin')->group(function(){
  Route::get('/admin', function(){
  	return view('auth.dashboard_admin');
    
  });


//List Route yang digunakan untuk CRUD Admin
  Route::resource('/product','ControllerProduct');

  //--Route Untuk Soft Delete pada Admin Product--//
    //route get all data trash product
    Route::get('/product-trash','ControllerProduct@trash');
    //route restore product
    Route::get('/product-restore/{id}', 'ControllerProduct@restore');
    Route::get('/product-restore-all', 'ControllerProduct@restore_all');
    //route hapus permanen
    Route::get('/product-hapus_permanen/{id}', 'ControllerProduct@hapus');
    Route::get('/product-hapus_permanen', 'ControllerProduct@hapus_semua');
  //-- End Route Untuk Soft Delete pada Admin Product --//

  //--Route untuk diskon--//

    Route::get('/discount/{id}','ControllerDiscount@discount');
    Route::post('/discount-store','ControllerDiscount@store');
    Route::put('/discount-update/{id}','ControllerDiscount@update');
    Route::get('/discount-delete/{id}','ControllerDiscount@delete');
    
  //--End route untuk diskon--//

  Route::resource('/product-category','ControllerProductCategory');

    //--Route untuk soft delete admin product category--//

    //-- End Route untuk soft delete admin product category --//
  
  Route::resource('/courier','ControllerCourier');
  Route::get('/gambar/{id}','ControllerProduct@editGambar');
  Route::match(['put', 'patch'],'/gambar/{id}/update', 'ControllerProduct@updateGambar');
  Route::get('admin/logout', 'Auth\AdminAuthController@postLogout');
});


Route::get('/user/show','UserController@showAll');
Route::get('/user/detail/{id}','UserController@detail');

Route::get('user/logout', 'UserController@logout');
  
Route::middleware('auth')->group(function(){
  Route::get('/user/transaksi-langsung/{id}','UserController@transaksiLangsung');  
});

