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

Route::get('institusi', 'InstitusiController@index');
Route::post('register', 'RegisterController@submit');
Route::post('login', 'AuthController@login');
Route::get('institusi/bank/{id}', 'InstitusiController@getBank');