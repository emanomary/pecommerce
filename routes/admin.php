<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * note that the prefix is admin for all file route.
*/
Route::group(['namespace'=>'Dashboard','middleware'=>'auth:admin'],function ()
{
    //first page admin visits if authentecated
    Route::get('/','DashboardController@index')->name('dashboard.index');
});

/*
 * routes to admin login
*/
Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin'],function (){
    route::get('login','LoginController@login')->name('admin.login');
    Route::post('login','LoginController@postLogin')->name('admin.post.login');
});
