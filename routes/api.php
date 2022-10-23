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

// client
Route::get('/client/list','ClientController@index');
Route::post('/client/create','ClientController@create');
Route::get('/client/view/{id}','ClientController@view');

// stock

Route::get('/stock/list','StockController@index');
Route::post('/stock/create','StockController@create');
Route::get('/stock/view/{id}','StockController@view');
Route::delete('/stock/view/{id}','StockController@delete');




