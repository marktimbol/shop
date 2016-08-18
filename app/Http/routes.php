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
Route::get('items/{items}', ['as' => 'items.show', 'uses' => 'ItemsController@show']);

Route::get('cart', ['as' => 'cart.index', 'uses' => 'CartController@index']);
Route::post('cart', ['as' => 'cart.store', 'uses' => 'CartController@store']);
Route::get('checkout', ['as' => 'checkout', 'uses' => 'CheckoutController@index']);
Route::post('checkout', 'CheckoutController@store');
Route::get('checkout/success', [
	'as' => 'checkout.success', 
	'uses' => 'CheckoutSuccessController@index'
]);

Route::auth();
Route::get('/home', 'HomeController@index');

Route::post(
	'stripe/webhook',
	'\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);
