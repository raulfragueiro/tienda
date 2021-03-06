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
// Rutas Actualización a Laravel 5.3
//Route::post('/logout', 'Auth\LoginController@logout');
//
Auth::routes();
Route::bind('product', function($slug){
   return App\Product::where('slug',$slug)->first();
});

Route::get('/', [
    'as' => 'home',
    function(){
        $cart = \Session::get('cart');
        $totalqty = 0;
        if ($cart!= null){
        foreach ($cart as $item){
            $totalqty += $item->quantity;
        }
        }


    $products=Product::all();
    return view('welcome', compact('products','totalqty'));
}]);


Route::get('/store',[
    'as' => 'store',
    'uses'=> 'StoreController@index'
]);
Route::auth();

Route::get('/home/{id}', [
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
Route::get('order-detail', [
   'middleware' => 'auth',
    'as' => 'order-detail',
    'uses' => 'CartController@orderDetail'
]);
Route::post('/eliminar/{id}', [
    'as' => 'eliminar',
    'uses' => 'CartController@destroyUser'
]);
Route::post('/update', [
    'as' => 'updateUser',
    'uses' => 'CartController@updateUser'
]);
Route::get('/keep', [
    'as' => 'keep',
    'uses' => 'CartController@keep'
]);

/*
 * @Rutas actualizar Carrito
 */
Route::post('/updateShipping', [
    'as' => 'updateShipping',
    'uses' => 'CartController@updateShipping'
]);
Route::get('/register/confirm/{token}', [
    'uses' => 'Auth\RegisterController@confirmEmail'
]);
/*
 * @Rutas Paypal
 */
Route::get('payment', array(
    'as' => 'payment',
    'uses' => 'PaypalController@postPayment',
));
/*
 * Rutas PayPal status
 */
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));

Route::get('/order/{id}', array(
    'as' => 'order',
    'uses' => 'HomeController@getorder',
));
/*
 * Rutas para RSS
 */
Route::get('/genRss', 'rssController@genRss')->middleware('auth');
Route::get('/rss', 'rssController@rss');


/*
 * Rutas para PDF
 */
Route::get('/pdf', function() {

    if(!count(\Session::get('cart')))
    {
        return redirect()->route('home');
    }else{
        $cart = \Session::get('cart');
        $pdf = PDF::loadView('store.doc', ['cart' => $cart]);
        return $pdf->download('javishop-doc.pdf');
    }
})->middleware('auth');

/*
 * Guardar carrito en la base de datos
 */
Route::get('/save-cart/', array(
    'as' => 'saveCart',
    'uses' => 'CartController@saveCart',
))->middleware('auth');


Route::get('/get-cart/{id}', array(
    'as' => 'getCart',
    'uses' => 'CartController@getCart',
))->middleware('auth');
Route::get('/myCart-delete/{id}', array(
    'as' => 'myCart-delete',
    'uses' => 'CartController@destroy',
))->middleware('auth');