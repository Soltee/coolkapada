<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\OrderController;

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

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/order/{order}', [HomeController::class, 'show'])
                            ->name('customer.order');

    Route::patch('/home/{user}', [HomeController::class, 'update'])
                            ->name('customer.reset');
});

//Admin Pages
Route::get('/admin/login', [LoginController::class, 'index'])
                            ->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])
                            ->name('admin.login');
                            
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){

    //Categories
	Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
	Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
	Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
	Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


    //Customers
    Route::get('/customers', [CustomerController::class, 'index'])
                        ->name('admin.customers.view');
	Route::get('/customers/{customer}', [CustomerController::class, 'show'])                    ->name('admin.customer');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
                        ->name('admin.customers.destroy');


    Route::get('/dashboard', [DashboardController::class, 'index'])
                            ->name('admin.dashboard');
    Route::get('/profile', [DashboardController::class, 'show'])
                            ->name('admin.profile');
                            Route::post('/admin/logout', [LoginController::class, 'logout'])
                            ->name('admin.logout');

    Route::patch('/profile/{id}', [DashboardController::class, 'update'])
                            ->name('admin.update');  
                            
    //Products
    Route::get('/products', [ProductController::class, 'index'])
            ->name('admin.products.view');
    Route::get('/products/create', [ProductController::class, 'create'])               
            ->name('product.create');
    Route::get('/products/{product}', [ProductController::class, 'show'])
            ->name('admin.product');

    Route::post('/products', [ProductController::class, 'store'])
            ->name('admin.products.store');
    Route::patch('/products/{product}', [ProductController::class, 'update'])
            ->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('admin.products.destroy');

    //product Image
    Route::get('/products/{product}/images/create',[ProductImageController::class, 'create'])               
        ->name('product.image.create');

    //Medias
    Route::get('/medias', [MediaController::class, 'index'])
                            ->name('medias');         
    Route::post('/medias', [MediaController::class, 'store'])
                            ->name('media.store');         
    Route::delete('/medias/{media}', [MediaController::class, 'destroy'])
                            ->name('media.destroy');   

    //Newsletter
    Route::get('/newsletters', [NewsletterController::class, 'index']);
    Route::delete('/newsletters/{newsletter}', [NewsletterController::class, 'destroy'])
        ->name('newsletter.destroy');   

    //Orders
    Route::get('/orders', [OrderController::class, 'index'])
                                ->name('admin.orders.view');
    Route::get('/orders/{order}', [OrderController::class, 'show'])
                                ->name('admin.order');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])
                                ->name('admin.orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
                                ->name('admin.orders.delete');


});

require __DIR__.'/auth.php';


