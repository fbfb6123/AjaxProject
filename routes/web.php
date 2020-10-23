<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dataaddcon;
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


Route::get('dataadd', function()
{
    return view('dataadd'); //登録画面表示
});


Route::post('dataadd',[dataaddcon::class, 'add']); //データ登録
