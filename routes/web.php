<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisaController;
use App\Http\Controllers\SecaoController;
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

//Rotas para as Seções em json
Route::resource('secoes',SecaoController::class);

//Route::resource('divisas', DivisaController::class);
Route::resource('divisas', DivisaController::class);
Route::resource('secoes', SecaoController::class);
Route::get('/', function () {
    return view('welcome');
});

// Permite usar Gate::check('user')na view 404
Route::fallback(function(){
    return view('errors.404');
 });
