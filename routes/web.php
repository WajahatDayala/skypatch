<?php

use App\Http\Controllers\customer\QuotesController;
use App\Http\Controllers\customer\OrdersController;
use App\Http\Controllers\customer\VectorsController;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\customer\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

//admin 
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AllQuotesController;
use App\Http\Controllers\Admin\AllOrdersController;
use App\Http\Controllers\Admin\AllVectorController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AsignLeaderController;

Route::get('/', function () {

    return view('auth/login');
});


Route::get('/dashboard', function () {
    return view('customer/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
 //   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    //customer 
    ///profile
    Route::resource('/customer/my-profile',ProfileController::class);
    //quotes
    Route::resource('/customer/quotes',QuotesController::class);
  
    //orders
    Route::resource('/customer/orders',OrdersController::class);
    Route::get('/customer/today-orders', [OrdersController::class, 'todayDayQuote']);
    //vector orders
    Route::resource('/customer/vector-orders',VectorsController::class);
 
    //convert quotes to order
    Route::post('/customer/convert-quote/{quoteId}', [QuotesController::class, 'convertToOrder']);

    
});


/* Admin Auth */
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    //customer
    Route::resource('/admin/customers',CustomerController::class);
    Route::get('/admin/allcustomers', [CustomerController::class, 'allCustomer']);
    //all quotes
    Route::resource('/admin/allquotes',AllQuotesController::class);
    Route::get('/admin/today-quotes', [AllQuotesController::class, 'todayDayQuote']);
    //all orders
    Route::resource('/admin/allorders',AllOrdersController::class);
    Route::get('/admin/today-orders', [AllOrdersController::class, 'todayDayOrders']);
    Route::get('/admin/today-edit-orders', [AllOrdersController::class, 'todayDayEditOrders']);

    
    //all vectors
     Route::resource('/admin/allvectors',AllVectorController::class);
     Route::get('/admin/today-vector', [AllVectorController::class, 'todayDayVector']);

      //all employees
      Route::resource('/admin/employees',EmployeeController::class);
      
      //asign leaders
      Route::resource('/admin/assign-leaders',AsignLeaderController::class);
      Route::post('/admin/assign-leaders/{id}/assign-leader', [AsignLeaderController::class, 'assignLeader'])->name('assign-leaders.assign-leader');

      

     

});
/*end admin routing  */

require __DIR__.'/auth.php';
