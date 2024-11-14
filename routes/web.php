<?php

use App\Http\Controllers\Customer\QuotesController;
use App\Http\Controllers\Customer\OrdersController;
use App\Http\Controllers\Customer\VectorsController;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\DashboardController;

use App\Http\Controllers\Customer\ProfileController;
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
use App\Http\Controllers\Admin\InvoiceControlller;

//digitizer quote worker.
use App\Http\Controllers\Digitizer\Quote\Worker\WorkerDashboardController;
use App\Http\Controllers\Digitizer\Quote\Worker\WorkerQuoteController;
//digitizer quote leader.
use App\Http\Controllers\Digitizer\Quote\Leader\QuoteLeaderDashboard;
use App\Http\Controllers\Digitizer\Quote\Leader\LeaderQuoteController;
//digitizer order worker
use App\Http\Controllers\Digitizer\Order\Worker\OrderWorkerDashboardController;
use App\Http\Controllers\Digitizer\Order\Worker\WorkerOrderController;
//digitizer order leader
use App\Http\Controllers\Digitizer\Order\Leader\OrderLeaderDashboardController;
use App\Http\Controllers\Digitizer\Order\Leader\LeaderOrderController;
//digitizer vector worker
use App\Http\Controllers\Digitizer\Vector\Worker\VectorWorkersDashboardController;
use App\Http\Controllers\Digitizer\Vector\Worker\VectorWorkerController;

//digitizer vector leader
use App\Http\Controllers\Digitizer\Vector\Leader\VectorLeaderDashboardController;
use App\Http\Controllers\Digitizer\Vector\Leader\VectorLeaderController;



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
    Route::resource('/customer/my-profile', ProfileController::class);
    Route::get('customer/my-profile/{id}/billInfo', [ProfileController::class, 'billInfo'])->name('my-profile.billInfo');
    Route::post('customer/updateBill', [ProfileController::class, 'storeBillInfo'])->name('customer.updateBill');
    //quotes
    Route::resource('/customer/quotes', QuotesController::class);

    //orders
    Route::resource('/customer/orders', OrdersController::class);
    Route::get('/customer/today-orders', [OrdersController::class, 'todayDayQuote']);
    //vector orders
    Route::resource('/customer/vector-orders', VectorsController::class);

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
    Route::resource('/admin/customers', CustomerController::class);
    Route::post('/admin/customers/updateBill', [CustomerController::class, 'updateBIlInfo'])->name('customer.updatedBill');
    Route::get('/admin/allcustomers', [CustomerController::class, 'allCustomer']);
    Route::get('/admin/customers/{id}/dashboard', [CustomerController::class, 'showPanel'])->name('customer.dashboard');
    //add invoice
    Route::get('/admin/customers/{id}/addinvoice', [CustomerController::class, 'addInvoice'])->name('customer.addinvoice');
    Route::post('/admin/customers/storeinvoice', [CustomerController::class, 'storeInvoice'])->name('customer.storeinvoice'); //customer panel profile from admin panel
    Route::get('/admin/customers/{id}/my-profile', [CustomerController::class, 'customerProfile'])->name('customer.my-profile');
    Route::get('/admin/customers/{id}/edit-profile', [CustomerController::class, 'customerProfileEdit'])->name('customer.edit-profile');
    Route::post('/admin/customers/{id}/update-profile', [CustomerController::class, 'customerProfileUpdate'])->name('customer.update-profile');
    Route::get('/admin/customers/{id}/editBillInfo', [CustomerController::class, 'customerBillInfo'])->name('customer.editBillInfo');

    Route::get('/admin/customers/{id}/billInfo', [CustomerController::class, 'billInfo'])->name('customers.billInfo');
    Route::post('/admin/customers/updateBillInfo', [CustomerController::class, 'storeBillInfo'])->name('customers.updateBillInfo');
    //customer orders from admin
    Route::get('/admin/customers/{id}/quote', [CustomerController::class, 'createQuote'])->name('customer.quote');
    Route::post('/admin/customers/savedQuote', [CustomerController::class, 'storeQuote'])->name('customer.savedQuote');
    Route::get('/admin/customers/{id}/all-quotes', [CustomerController::class, 'allQuotes'])->name('customer.all-quotes');
    Route::get('/admin/customers/{id}/show-quote', [CustomerController::class, 'showQuote'])->name('customer.show-quote');
    Route::get('/admin/customers/{id}/edit-quote', [CustomerController::class, 'editQuote'])->name('customer.edit-quote');
    Route::post('/admin/customers/{id}/all-quotes/convert-quotes/{quoteId}', [CustomerController::class, 'convertToOrder']);



    //all quotes
    Route::resource('/admin/allquotes', AllQuotesController::class);
    Route::get('/admin/today-quotes', [AllQuotesController::class, 'todayDayQuote']);
    Route::post('/admin/allquotes/{id}/allquote', [AllQuotesController::class, 'assignDesigner'])->name('allquotes.allquote');
    Route::post('/admin/allquotes/addInstruction', [AllQuotesController::class, 'storeInstruction'])->name('allquotes.addInstruction');
    Route::post('/admin/allquotes/adminInstruction', [AllQuotesController::class, 'storeAdminInstruction'])->name('allquotes.adminInstruction');
    Route::post('/admin/allquotes/uploadFile', [AllQuotesController::class, 'storeFile'])->name('allquotes.uploadFile');
    Route::post('/admin/allquotes/deleteFile', [AllQuotesController::class, 'deleteFile'])->name('allquotes.deleteFile');
    Route::post('/admin/allquotes/updateStatus', [AllQuotesController::class, 'orderStatus'])->name('allquotes.updateStatus');
    Route::get('/admin/allquotes/{id}/process', [AllQuotesController::class, 'showProcess'])->name('allquotes.process');
    //option A B
    Route::post('/admin/allquotes/optionA', [AllQuotesController::class, 'storeOptionA'])->name('allquotes.optionA');
    Route::post('/admin/allquotes/optionB', [AllQuotesController::class, 'storeOptionB'])->name('allquotes.optionB');



    //all orders
    Route::resource('/admin/allorders', AllOrdersController::class);
    Route::get('/admin/today-orders', [AllOrdersController::class, 'todayDayOrders']);
    Route::get('/admin/today-edit-orders', [AllOrdersController::class, 'todayDayEditOrders']);
    Route::get('/admin/allorders/{id}/process', [AllOrdersController::class, 'processOrder'])->name('allorders.process');
    Route::get('/admin/allorders/{id}/print', [AllOrdersController::class, 'printOrder'])->name('allorders.print');

    Route::post('/admin/allorders/{id}/allorder', [AllOrdersController::class, 'assignDesigner'])->name('allorders.allorder');
    Route::post('/admin/allorders/addInstruction', [AllOrdersController::class, 'storeInstruction'])->name('allorders.addInstruction');
    Route::post('/admin/allorders/adminInstruction', [AllOrdersController::class, 'storeAdminInstruction'])->name('allorders.adminInstruction');
    Route::post('/admin/allorders/uploadFile', [AllOrdersController::class, 'storeFile'])->name('allorders.uploadFile');
    Route::post('/admin/allorders/deleteFile', [AllOrdersController::class, 'deleteFile'])->name('allorders.deleteFile');
    Route::post('/admin/allorders/updateStatus', [AllOrdersController::class, 'orderStatus'])->name('allorders.updateStatus');
    Route::post('/admin/allorders/updateReason', [AllOrdersController::class, 'addReason'])->name('allorders.updateReason');
    //options
    Route::post('/admin/allorders/optionA', [AllOrdersController::class, 'storeOptionA'])->name('allorders.optionA');
    Route::post('/admin/allorders/optionB', [AllOrdersController::class, 'storeOptionB'])->name('allorders.optionB');

    //all vectors
    Route::resource('/admin/allvectors', AllVectorController::class);
    Route::get('/admin/today-vector', [AllVectorController::class, 'todayDayVector']);
    Route::post('/admin/allvectors/{id}/allvector', [AllVectorController::class, 'assignDesigner'])->name('allvectors.allvecto');
    Route::post('/admin/allvectors/addInstruction', [AllVectorController::class, 'storeInstruction'])->name('allvectors.addInstruction');
    Route::post('/admin/allvectors/adminInstruction', [AllVectorController::class, 'storeAdminInstruction'])->name('allvectors.adminInstruction');
    Route::post('/admin/allvectors/uploadFile', [AllVectorController::class, 'storeFile'])->name('allvectors.uploadFile');
    Route::post('/admin/allvectors/deleteFile', [AllVectorController::class, 'deleteFile'])->name('allvectors.deleteFile');
    Route::post('/admin/allvectors/updateStatus', [AllVectorController::class, 'orderStatus'])->name('allvectors.updateStatus');

    //option A B
    Route::post('/admin/allvectors/optionA', [AllVectorController::class, 'storeOptionA'])->name('allvectors.optionA');
    Route::post('/admin/allvectors/optionB', [AllVectorController::class, 'storeOptionB'])->name('allvectors.optionB');
    
    


    //invoices 
    Route::resource('/admin/invoices', InvoiceControlller::class);
    Route::get('/admin/invoice/{id}/download', [InvoiceControlller::class, 'downloadPDF'])->name('invoice.download');


    //all employees
    Route::resource('/admin/employees', EmployeeController::class);

    //asign leaders
    Route::resource('/admin/assign-leaders', AsignLeaderController::class);
    Route::post('/admin/assign-leaders/{id}/assign-leader', [AsignLeaderController::class, 'assignLeader'])->name('assign-leaders.assign-leader');


    /* digitizer */
    //quote worker

    Route::get('/quote-worker/dashboard', [WorkerDashboardController::class, 'index'])->name('quote-worker.dashboard');
    Route::resource('/quote-worker/all-worker-quotes', WorkerQuoteController::class);
    Route::get('/quote-worker/today-worker-quotes', [WorkerQuoteController::class, 'todayDayQuote'])->name('quote-worker.today-quotes');
    Route::get('/quote-worker/all-worker-quotes/{id}/process', [WorkerQuoteController::class, 'showProcess'])->name('all-worker-quote.process');
    //quote leader
    Route::get('/quote-leader/dashboard', [QuoteLeaderDashboard::class, 'index'])->name('quote-leader.dashboard');
    Route::resource('/quote-leader/all-leader-quotes', LeaderQuoteController::class);
    Route::get('/quote-leader/today-leader-quotes', [LeaderQuoteController::class, 'todayDayQuote'])->name('quote-leader.today-quotes');
    Route::get('/quote-leader/all-leader-quotes/{id}/process', [LeaderQuoteController::class, 'showProcess'])->name('all-leader-quote.process');

    //order worker
    Route::get('/order-worker/dashboard', [OrderWorkerDashboardController::class, 'index'])->name('order-worker.dashboard');
    Route::resource('/order-worker/all-worker-orders', WorkerOrderController::class);
    Route::get('/order-worker/today-worker-order', [WorkerOrderController::class, 'todayDayOrders'])->name('order-worker.today-orders');
    Route::get('/order-worker/all-worker-order/{id}/process', [WorkerOrderController::class, 'showProcess'])->name('all-worker-orders.process');
    //order leader
    Route::get('/order-leader/dashboard', [OrderLeaderDashboardController::class, 'index'])->name('order-leader.dashboard');
    Route::resource('/order-leader/all-leader-orders', LeaderOrderController::class);
    Route::get('/order-leader/today-leader-order', [LeaderOrderController::class, 'todayDayOrders'])->name('order-leader.today-leader-order');
    Route::get('/order-leader/all-leader-order/{id}/process', [LeaderOrderController::class, 'showProcess'])->name('all-leader-orders.process');
    

    //vector leader
    Route::get('/vector-leader/dashboard', [VectorLeaderDashboardController::class, 'index'])->name('vector-leader.dashboard');
    Route::resource('/vector-leader/all-leader-vector-order', VectorLeaderController::class);
    Route::get('/vector-leader/today-leader-vector-order', [VectorLeaderController::class, 'todayVectorOrders'])->name('vector-leader.today-leader-vector-order');
    Route::get('/vector-leader/all-leader-vector/{id}/process', [VectorLeaderController::class, 'showProcess'])->name('all-leader-vectors.process');
    
    //vector worker
    Route::get('/vector-worker/dashboard', [VectorWorkersDashboardController::class, 'index'])->name('vector-worker.dashboard');
    Route::resource('/vector-worker/all-worker-vector-order', VectorWorkerController::class);
    Route::get('/vector-worker/today-worker-vector-order', [VectorWorkerController::class, 'todayVectorOrders'])->name('vector-worker.today-worker-vector-order');
    Route::get('/vector-worker/all-worker-vector/{id}/process', [VectorWorkerController::class, 'showProcess'])->name('all-worker-vectors.process');
   

    
    
    /* digitizer */



});
/*end admin routing  */




require __DIR__ . '/auth.php';
