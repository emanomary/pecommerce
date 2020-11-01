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
        Route::get('logout','LoginController@logout')->name('admin.logout');
        //shipping
        Route::group(['prefix'=>'settings'],function (){
            Route::get('setting-methods/{type}','SettingController@editShipping')->name('edit.shipping');
            Route::put('setting-methods/{id}','SettingController@updateShipping')->name('update.shipping');

        });

        //profile
        Route::group(['prefix'=>'profile'],function (){
            Route::get('edit','ProfileController@edit')->name('profile.edit');
            Route::put('update','ProfileController@update')->name('profile.update');

        });

        #################### categories routes ############################
        Route::group(['prefix'=>'main_categories'],function (){
            Route::get('/','MainCategoryController@index')->name('maincategories.index');
            Route::get('create','MainCategoryController@create')->name('maincategories.create');
            Route::post('store','MainCategoryController@store')->name('maincategories.store');
            Route::get('edit/{id}','MainCategoryController@edit')->name('maincategories.edit');
            Route::post('update/{id}','MainCategoryController@update')->name('maincategories.update');
            Route::get('delete/{id}','MainCategoryController@delete')->name('maincategories.delete');
        });
        #################### end categories routes ############################



    });

    /*
     * routes to admin login
    */
    Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){
        route::get('login','LoginController@login')->name('admin.login');
        Route::post('login','LoginController@postLogin')->name('admin.post.login');
    });

});
