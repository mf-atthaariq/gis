<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitikController;
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
Route::get('/',[TitikController::class,'index']);
Route::get('/titik/data',[TitikController::class,'allTitik']);
Route::get('/titik/{id}',[TitikController::class,'titik']);
# Route::get('/', function () {return view('home');});
