<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('services/informasi', 'Api\ApiInfoController@Api');
Route::get('services/informasi/{id}', 'Api\ApiInfoController@Api');
Route::get('services/kategori', 'Api\ApiKategoriController@Api');
Route::get('services/kategori/{id}', 'Api\ApiKategoriController@Api');
