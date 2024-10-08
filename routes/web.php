<?php

use App\Http\Controllers\customer\QuotesController;
use App\Http\Controllers\customer\OrdersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('customer/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    //customer 
    //quotes
    Route::resource('/customer/quotes',QuotesController::class);
    Route::get('/customer/today-quotes', [QuotesController::class, 'todayDayQuote']);
    //orders
    Route::resource('/customer/orders',OrdersController::class);
    Route::get('/customer/today-orders', [OrdersController::class, 'todayDayQuote']);

});




require __DIR__.'/auth.php';
