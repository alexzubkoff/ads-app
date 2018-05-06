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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'AdController@index');
Route::get('/ads', 'AdController@index')->name('list_ads');
Route::group(['prefix' => 'ads'], function () {
    Route::get('/drafts', 'AdController@drafts')
        ->name('list_drafts')
        ->middleware('auth');
    Route::get('/show/{id}', 'AdController@show')
        ->name('show_ad');
    Route::get('/create', 'AdController@create')
        ->name('create_ad')
        ->middleware('can:create-ad');
    Route::post('/create', 'AdController@store')
        ->name('store_ad')
        ->middleware('can:create-ad');
    Route::get('/edit/{ad}', 'AdController@edit')
        ->name('edit_ad')
        ->middleware('can:update-ad,ad');
    Route::post('/edit/{ad}', 'AdController@update')
        ->name('update_ad')
        ->middleware('can:update-ad,ad');
    // using get to simplify
    Route::get('/publish/{ad}', 'AdController@publish')
        ->name('publish_ad')
        ->middleware('can:publish-ad');
});