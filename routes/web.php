<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Customer\HomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//Bag Cart
Route::get('/bag', [BagController::class, 'index'])->name('cart');
Route::post('/cart/store', [BagController::class, 'store'])
                                            ->name('cart.store');
Route::patch('/cart/{product}', [BagController::class, 'update'])
                                            ->name('cart.update');
Route::delete('/cart/{item}', [BagController::class, 'remove'])
                                            ->name('cart.remove');
Route::delete('/cart', [BagController::class, 'destroy'])->name('cart.destroy');

/*Checkout*/
Route::get('/checkout', [CheckoutController::class, 'index'])
                            ->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])
                            ->name('checkout.store');

Route::get('/thankyou/{order}', [CheckoutController::class, 'show'])->name('thankyou');


//Shop & Product 
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product');

//Bag
Route::post('/bag/store', [BagController::class, 'store'])->name('bag.store');

//Newsletter 
Route::post('/newsletter', [WelcomeController::class, 'newsletter']);

Route::group(['middleware' => 'auth:customer'], function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
});

require __DIR__.'/auth.php';
