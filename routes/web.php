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

Route::group(['prefix' => '{lang}'], function () {
    
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::resource('categories', 'CategoriesController');
    });
    
});
