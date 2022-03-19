<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\PessoaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::resource('pessoas', \App\Http\Controllers\PessoaController::class);
Route::get('pessoas/cache', [PessoaController::class, 'index_cache']);
Route::get('pessoas/sem-cache', [PessoaController::class, 'index_sem_cache']);
Route::get('pessoas/set-cache', [PessoaController::class, 'set_cache']);
