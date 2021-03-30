<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BagController;
use App\Http\Controllers\Customer\HomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//Bag
Route::post('/bag/store', [BagController::class, 'store'])->name('bag.store');

//Newsletter 
Route::post('/newsletter', [WelcomeController::class, 'newsletter']);

Route::group(['middleware' => 'auth:customer'], function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
});

require __DIR__.'/auth.php';
