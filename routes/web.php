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

Route::get('/', function(){
    return view('welcome');
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

/*
Route::get('profile', function(){
    // Only verified users may enter...
})->middleware('verified');
*/
Route::resource('setting', 'SettingController');

Route::resource('acceptance', 'AcceptanceController');
Route::get('acceptance/sheet/{url_token}', 'AcceptanceSheetController@edit');
Route::put('acceptance/sheet/{url_token}', 'AcceptanceSheetController@update');
