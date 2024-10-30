<?php

use App\Http\Controllers\customer\QuotesController;
use App\Http\Controllers\customer\OrdersController;
use App\Http\Controllers\customer\VectorsController;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\customer\DashboardController;

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


Route::get('/customer/dashboard', function () {
    return view('customer/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
// User routes
Route::group(['middleware' => 'auth:web'], function () {

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
    Route::get('/admin/customers/{id}/dashboard',[CustomerController::class,'showPanel'])->name('customer.dashboard');
    Route::get('/admin/customers/{id}/billInfo', [CustomerController::class, 'billInfo'])->name('customers.billInfo');
    Route::post('/admin/customers/updateBillInfo', [CustomerController::class, 'storeBillInfo'])->name('customers.updateBillInfo');
    //customer orders from admin
    Route::get('/admin/customers/{id}/quote',[CustomerController::class,'createQuote'])->name('customer.quote');
    Route::post('/admin/customers/savedQuote', [CustomerController::class, 'storeQuote'])->name('customer.savedQuote');
    Route::get('/admin/customers/{id}/all-quotes',[CustomerController::class,'allQuotes'])->name('customer.all-quotes');
    Route::get('/admin/customers/{id}/show-quote',[CustomerController::class,'showQuote'])->name('customer.show-quote');


    //all quotes
    Route::resource('/admin/allquotes',AllQuotesController::class);
    Route::get('/admin/today-quotes', [AllQuotesController::class, 'todayDayQuote']);
    Route::post('/admin/allquotes/{id}/allquote', [AllQuotesController::class, 'assignDesigner'])->name('allquotes.allquote');
    Route::post('/admin/allquotes/addInstruction', [AllQuotesController::class, 'storeInstruction'])->name('allquotes.addInstruction');
    Route::post('/admin/allquotes/adminInstruction', [AllQuotesController::class, 'storeAdminInstruction'])->name('allquotes.adminInstruction');
    Route::post('/admin/allquotes/uploadFile', [AllQuotesController::class, 'storeFile'])->name('allquotes.uploadFile');
    Route::post('/admin/allquotes/deleteFile', [AllQuotesController::class, 'deleteFile'])->name('allquotes.deleteFile'); 
    Route::post('/admin/allquotes/updateStatus', [AllQuotesController::class, 'orderStatus'])->name('allquotes.updateStatus');
  

    //all orders
    Route::resource('/admin/allorders',AllOrdersController::class);
    Route::get('/admin/today-orders', [AllOrdersController::class, 'todayDayOrders']);
    Route::get('/admin/today-edit-orders', [AllOrdersController::class, 'todayDayEditOrders']);
    Route::post('/admin/allorders/{id}/allorder', [AllOrdersController::class, 'assignDesigner'])->name('allorders.allorder');
    Route::post('/admin/allorders/addInstruction', [AllOrdersController::class, 'storeInstruction'])->name('allorders.addInstruction');
    Route::post('/admin/allorders/adminInstruction', [AllOrdersController::class, 'storeAdminInstruction'])->name('allorders.adminInstruction');
    Route::post('/admin/allorders/uploadFile', [AllOrdersController::class, 'storeFile'])->name('allorders.uploadFile');
    Route::post('/admin/allorders/deleteFile', [AllOrdersController::class, 'deleteFile'])->name('allorders.deleteFile'); 
    Route::post('/admin/allorders/updateStatus', [AllOrdersController::class, 'orderStatus'])->name('allorders.updateStatus');
    Route::post('/admin/allorders/updateReason', [AllOrdersController::class, 'addReason'])->name('allorders.updateReason');

    

    //all vectors
     Route::resource('/admin/allvectors',AllVectorController::class);
     Route::get('/admin/today-vector', [AllVectorController::class, 'todayDayVector']);
     Route::post('/admin/allvectors/{id}/allvector', [AllVectorController::class, 'assignDesigner'])->name('allvectors.allvecto');
     Route::post('/admin/allvectors/addInstruction', [AllVectorController::class, 'storeInstruction'])->name('allvectors.addInstruction');
     Route::post('/admin/allvectors/adminInstruction', [AllVectorController::class, 'storeAdminInstruction'])->name('allvectors.adminInstruction');
     Route::post('/admin/allvectors/uploadFile', [AllVectorController::class, 'storeFile'])->name('allvectors.uploadFile');
     Route::post('/admin/allvectors/deleteFile', [AllVectorController::class, 'deleteFile'])->name('allvectors.deleteFile'); 
     Route::post('/admin/allvectors/updateStatus', [AllVectorController::class, 'orderStatus'])->name('allvectors.updateStatus');
   
   

      //all employees
      Route::resource('/admin/employees',EmployeeController::class);
      
      //asign leaders
      Route::resource('/admin/assign-leaders',AsignLeaderController::class);
      Route::post('/admin/assign-leaders/{id}/assign-leader', [AsignLeaderController::class, 'assignLeader'])->name('assign-leaders.assign-leader');



     

});
/*end admin routing  */

require __DIR__.'/auth.php';
