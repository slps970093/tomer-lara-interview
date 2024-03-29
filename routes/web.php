<?php

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

Route::get('/', 'TodoController@index');

Route::post('/','TodoController@create');


Route::post('modify/{id}','TodoController@modify');

Route::get('delete/{id}','TodoController@delete');


Route::get('completed/{id}','TodoController@completed');