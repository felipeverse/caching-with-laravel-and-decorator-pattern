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
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
    Route::get('/usuarios/create', 'UserController@create')->name('usuarios.create');
    Route::get('/usuarios/{id}', 'UserController@show')->name('usuarios.show');
    Route::post('/usuarios', 'UserController@store')->name('usuarios.store');
    Route::delete('/usuarios/{idd}', 'UserController@destroy')->name('usuarios.destroy');
});

