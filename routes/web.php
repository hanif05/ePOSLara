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

Route::redirect('/', 'en');
Route::get('/pusher', function() {
    return view('pusher');
});

Route::group(['prefix' => '{lang}'], function () {
    
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('admin/login', 'Admin\AuthController@index')->name('admin.auth');
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'jwt.verify'], function () {
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::resource('categories', 'CategoriesController');
    });
    
});
