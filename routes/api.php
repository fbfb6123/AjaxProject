<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\CsvImportController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('csv')->group(function () {
Route::match(['get', 'post'], '/csv/upload_regist', [CsvImportController::class, 'upload_regist']); //登録
});

//Ajax非同期バリデーション
Route::match(['get', 'post'], '/sample/inquiry', [SampleController::class, 'inquiry']); //登録

