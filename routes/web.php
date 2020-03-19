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
    return redirect('number');
    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('number', 'NumberController')->only(['index']);

Route::group(['middleware' => ['auth']], function()
{    
    Route::resource('number', 'NumberController')->except(['index']);
});

Route::resource('order', 'OrderController');
Route::resource('payment', 'PaymentController');
Route::resource('profiles', 'ProfilesController');