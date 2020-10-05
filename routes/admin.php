<?php

use Illuminate\Support\Facades\Auth;
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

//use multi language
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    //note that the prefix is admin for all file route.
    Route::group(['namespace'=>'Dashboard','middleware'=>'auth:admin','prefix'=>'admin'],function ()
    {
        //first page admin visits if authentecated
        Route::get('/','DashboardController@index')->name('dashboard.index');
        //shipping
        Route::group(['prefix'=>'settings'],function (){
            Route::get('setting-methods/{type}','SettingController@editShipping')->name('edit.shipping');
            Route::put('setting-methods/{id}','SettingController@updateShipping')->name('update.shipping');

        });

    });

    /*
     * routes to admin login
    */
    Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){
        route::get('login','LoginController@login')->name('admin.login');
        Route::post('login','LoginController@postLogin')->name('admin.post.login');
    });

});
