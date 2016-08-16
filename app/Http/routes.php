<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');

Route::get('cart', ['as' => 'cart.index', 'uses' => 'CartController@index']);
Route::post('cart', ['as' => 'cart.store', 'uses' => 'CartController@store']);
Route::get('items/{items}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);

Route::auth();
Route::get('/home', 'HomeController@index');
