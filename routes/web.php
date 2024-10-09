<?php

use App\Http\Controllers\customer\QuotesController;
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
    
    Route::resource('/customer/quotes',QuotesController::class);
    Route::get('/customer/today-quotes', [QuotesController::class, 'todayDayQuote']);

});




require __DIR__.'/auth.php';
