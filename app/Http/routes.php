<?php
use App\Product;
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
Route::bind('product', function($slug){
   return App\Product::where('slug',$slug)->first();
});

Route::get('/', function () {
    $products=Product::all();
    return view('welcome', compact('products'));
});
Route::get('/store',[
    'as' => 'store',
    'uses'=>'StoreController@index']);
Route::auth();

Route::get('/home', [
    'as'=>'perfil',
    'uses'=>'HomeController@index']);

Route::get('/product/{slug}',[
    'as'=>'product-detail',
    'uses'=>'StoreController@show'
    ]);
Route::get('/slider','StoreController@slide');

Route::get('cart/show', [
    'as' => 'cart-show',
    'uses' => 'CartController@show'
]);

Route::get('cart/add/{product}', [
    'as' => 'cart-add',
    'uses' => 'CartController@add'
]);
Route::get('cart/delete/{product}', [
    'as' => 'cart-delete',
    'uses' => 'CartController@delete'
]);

Route::get('cart/trash', [
    'as' => 'cart-trash',
    'uses' => 'CartController@trash'
]);
Route::post('cart/update/{product}/', [
    'as' => 'cart-update',
    'uses' => 'CartController@update'
]);