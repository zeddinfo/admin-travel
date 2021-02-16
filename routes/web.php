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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/kategori/list', 'Api\ApiKategoriController@list');
    Route::get('/informasi/list', 'Api\ApiInfoController@list');
    Route::get('/wisata/list', 'Api\ApiWisataController@list');
    Route::get('/armada/list', 'Api\ApiArmadaController@list');
});

Route::get('/login', 'Auth\LoginController@index');
Route::post('/auth', 'Auth\LoginController@auth');
Route::get('/admin', 'Dashboard\AdminController@index');


Route::group(['prefix' => 'wisata'], function () {
    Route::get('/', 'Wisata\WisataController@index');
    Route::get('/create', 'Wisata\WisataController@create');
    Route::post('/create', 'Wisata\WisataController@create');
    Route::post('/update/{id}', 'Wisata\WisataController@update');
    Route::get('/update/{id}', 'Wisata\WisataController@update');
    Route::post('/delete/{id}', 'Wisata\WisataController@delete');
});

Route::group(['prefix' => 'informasi'], function () {
    Route::get('/', 'Informasi\InformasiController@index');
    Route::get('/create', 'Informasi\InformasiController@create');
    Route::post('/create', 'Informasi\InformasiController@create');
    Route::get('/update/{id}', 'Informasi\InformasiController@update');
    Route::post('/update/{id}', 'Informasi\InformasiController@update');
    Route::post('/delete/{id}', 'Informasi\InformasiController@delete');
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', 'Kategori\KategoriController@index');
    Route::get('/create', 'Kategori\KategoriController@create');
    Route::post('/create', 'Kategori\KategoriController@create');
    Route::post('/update/{id}', 'Kategori\KategoriController@update');
    Route::get('/update/{id}', 'Kategori\KategoriController@update');
    Route::post('/delete/{id}', 'Kategori\KategoriController@delete');
});

Route::group(['prefix' => 'armada'], function () {
    Route::get('/', 'Armada\ArmadaController@index');
    Route::get('/create', 'Armada\ArmadaController@create');
    Route::post('/create', 'Armada\ArmadaController@create');
    Route::post('/update/{id}', 'Armada\ArmadaController@update');
    Route::get('/update/{id}', 'Armada\ArmadaController@update');
    Route::post('/delete/{id}', 'Armada\ArmadaController@delete');
});