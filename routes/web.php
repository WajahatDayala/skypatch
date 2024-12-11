<?php

use App\Http\Controllers\Customer\QuotesController;
use App\Http\Controllers\Customer\OrdersController;
use App\Http\Controllers\Customer\VectorsController;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\DashboardController;

use App\Http\Controllers\Customer\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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


//support
use App\Http\Controllers\Support\SupportDashboardController;
use App\Http\Controllers\Support\SupportCustomerController;
use App\Http\Controllers\Support\SupportQuotesController;
use App\Http\Controllers\Support\SupportOrdersController;
use App\Http\Controllers\Support\SupportVectorOrdersController;
use App\Http\Controllers\Support\SupportEmployeeController;
use App\Http\Controllers\Support\SupportInvoiceController;
use App\Http\Controllers\Support\SupportAssignLeaderController;


//accounts
use App\Http\Controllers\Accounts\AccounsDashboardController;
use App\Http\Controllers\Accounts\AccountCustomerController;
use App\Http\Controllers\Accounts\AccountQuotesController;
use App\Http\Controllers\Accounts\AccountOrdersController;
use App\Http\Controllers\Accounts\AccountVectorOrdersController;
use App\Http\Controllers\Accounts\AccountInvoiceController;
use App\Http\Controllers\Accounts\AccountEmployeeController;
use App\Http\Controllers\Accounts\AccountAssignLeaderController;


//sales
use App\Http\Controllers\Sales\SalesDashboardController;
use App\Http\Controllers\Sales\SalesCustomerController;
use App\Http\Controllers\Sales\SalesAllQuotesController;
use App\Http\Controllers\Sales\SalesOrdersController;
use App\Http\Controllers\Sales\SalesAllVectorsController;
use App\Http\Controllers\Sales\SalesEmployeeController;
use App\Http\Controllers\Sales\SalesInvoiceController;
use App\Http\Controllers\Sales\SalesAssignLeaderController;


//reports
use App\Http\Controllers\Reports\SalesTeamReportController;
use App\Http\Controllers\Reports\RecordAnnumController;
use App\Http\Controllers\Reports\SalesAnnumController;
use App\Http\Controllers\Reports\DesignReportController;
use App\Http\Controllers\Reports\AccountsReportController;






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
    Route::get('/customer/today-orders', [OrdersController::class, 'toDayOrder']);
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
    Route::get('/customers/{id}/dashboard', [CustomerController::class, 'showPanel'])->name('customer.dashboard');
    //add invoice
    Route::get('/admin/customers/{id}/addinvoice', [CustomerController::class, 'addInvoice'])->name('customer.addinvoice');
    Route::post('/admin/customers/storeinvoice', [CustomerController::class, 'storeInvoice'])->name('customer.storeinvoice'); //customer panel profile from admin panel
    Route::get('customers/{id}/my-profile', [CustomerController::class, 'customerProfile'])->name('customer.my-profile');
    Route::get('customers/{id}/edit-profile', [CustomerController::class, 'customerProfileEdit'])->name('customer.edit-profile');
    Route::post('customers/{id}/update-profile', [CustomerController::class, 'customerProfileUpdate'])->name('customer.update-profile');
    Route::get('customers/{id}/editBillInfo', [CustomerController::class, 'customerBillInfo'])->name('customer.editBillInfo');
    
    Route::get('/admin/customers/{id}/billInfo', [CustomerController::class, 'billInfo'])->name('customers.billInfo');
    Route::post('/admin/customers/updateBillInfo', [CustomerController::class, 'storeBillInfo'])->name('customers.updateBillInfo');


       //pricing criteria
       Route::get('/admin/pricing/{id}/pricing-details',[CustomerController::class,'editPricingDetails'])->name('pricing.pricing-details');
       Route::post('/admin/adminpricing/save/', [CustomerController::class, 'updatePriceDetails'])->name('adminpricing.save');
       
       //vector details
        Route::get('/admin/vectordetails/{id}/vector-details',[CustomerController::class,'editVectorDetails'])->name('vectordetails.vector-details');
        Route::post('/admin/adminvectordetails/save/',[CustomerController::class,'updateVectorDetails'])->name('adminvectordetails.save');
      
  

    //quotes for customer panel by admin roles
    Route::get('customers/{id}/quote', [CustomerController::class, 'createQuote'])->name('customer.quote');
    Route::post('customers/savedQuote', [CustomerController::class, 'storeQuote'])->name('customer.savedQuote');
    Route::get('customers/{id}/all-quotes', [CustomerController::class, 'allQuotes'])->name('customer.all-quotes');
    Route::get('customers/{id}/show-quote', [CustomerController::class, 'showQuote'])->name('customer.show-quote');
    Route::get('customers/{id}/edit-quote', [CustomerController::class, 'editQuote'])->name('customer.edit-quote');
    Route::post('customers/{id}/update-quote', [CustomerController::class, 'updateQuote'])->name('customer.update-quote');
    Route::post('customers/{id}/all-quotes/convert-quotes/{quoteId}', [CustomerController::class, 'convertToOrder']);

    //orders for customer panel by admin roles
    Route::get('customers/{id}/all-orders', [CustomerController::class, 'allOrders'])->name('customer.all-orders');
    Route::get('customers/{id}/show-order', [CustomerController::class, 'showOrder'])->name('customer.show-order');
    Route::get('customers/{id}/edit-order', [CustomerController::class, 'editOrder'])->name('customer.edit-order');
    Route::post('customers/{id}/update-order',[CustomerController::class,'updateOrder'])->name('customer.update-order');
    Route::get('customers/{id}/order', [CustomerController::class, 'createOrder'])->name('customer.order');
    Route::post('customers/savedOrder', [CustomerController::class, 'storeOrder'])->name('customer.savedOrder');
   
    //vector orders for customer panel by admin roles
    Route::get('customers/{id}/all-vector-orders', [CustomerController::class, 'allVectorOrder'])->name('customer.all-vector-orders');
    Route::get('customers/{id}/show-vector-order', [CustomerController::class, 'showVectorOrder'])->name('customer.show-vector-order');
    Route::get('customers/{id}/edit-vector-order', [CustomerController::class, 'editVectorOrder'])->name('customer.edit-vector-order');
    Route::post('customers/{id}/update-vector-order',[CustomerController::class,'updateVectorOrder'])->name('customer.update-vector-order');
    Route::get('customers/{id}/vector-order',[CustomerController::class,'createVectorOrder'])->name('customer.vector-order');
    Route::post('customers/savedVector',[CustomerController::class,'storeVectorOrder'])->name('customer.savedVector');
    
    Route::get('customers/{id}/invoices',[CustomerController::class,'showAllInvoices'])->name('customer.invoices');
    Route::get('customers/{id}/allorders',[CustomerController::class,'showAllInvoicesOrder'])->name('customer.allorders');
    Route::get('/customers/invoice/{id}/download', [CustomerController::class, 'downloadPDF'])->name('customer.download');
    
    
    Route::get('check-upload-limit', function () {
      $uploadMaxFilesize = ini_get('upload_max_filesize');
      $postMaxSize = ini_get('post_max_size');
  
      return response()->json([
          'upload_max_filesize' => $uploadMaxFilesize,
          'post_max_size' => $postMaxSize
      ]);
  });

    //all quotes
    Route::resource('/admin/allquotes', AllQuotesController::class);
    Route::get('/admin/today-quotes', [AllQuotesController::class, 'toDayQuote']);
    Route::get('/admin/allquotes/{id}/print', [AllQuotesController::class, 'printOrder'])->name('allquotes.print');
    Route::post('/admin/allquotes/{id}/allquote', [AllQuotesController::class, 'assignDesigner'])->name('allquotes.allquote');
    Route::post('/admin/allquotes/addInstruction', [AllQuotesController::class, 'storeInstruction'])->name('allquotes.addInstruction');
    Route::post('/admin/allquotes/adminInstruction', [AllQuotesController::class, 'storeAdminInstruction'])->name('allquotes.adminInstruction');
    Route::post('/admin/allquotes/uploadFile', [AllQuotesController::class, 'storeFile'])->name('allquotes.uploadFile');
    Route::post('/admin/allquotes/deleteFile', [AllQuotesController::class, 'deleteFile'])->name('allquotes.deleteFile');
    Route::post('/admin/allquotes/deleteFileA', [AllQuotesController::class, 'deleteFileA'])->name('allquotes.deleteFileA');
    Route::post('/admin/allquotes/deleteFileB', [AllQuotesController::class, 'deleteFileB'])->name('allquotes.deleteFileB');
    Route::post('/admin/allquotes/updateStatus', [AllQuotesController::class, 'orderStatus'])->name('allquotes.updateStatus');
    Route::get('/admin/allquotes/{id}/process', [AllQuotesController::class, 'showProcess'])->name('allquotes.process');
    //option A B
    Route::post('/admin/allquotes/optionA', [AllQuotesController::class, 'storeOptionA'])->name('allquotes.optionA');
    Route::post('/admin/allquotes/optionB', [AllQuotesController::class, 'storeOptionB'])->name('allquotes.optionB');
    Route::post('/admin/allquotes/send',[AllQuotesController::class,'sendEmailAndQuotes'])->name('allquotes.send');

    Route::post('/admin/allquotes/deleteQuote',[AllQuotesController::class,'deleteQuotes'])->name('allquotes.deleteQuote');
   //email test work
    Route::get('send-email',[AllQuotesController::class,'testMail']);

    //all orders
    Route::resource('/admin/allorders', AllOrdersController::class);
    Route::get('/admin/today-orders', [AllOrdersController::class, 'toDayOrders']);
    Route::get('/admin/today-edit-orders', [AllOrdersController::class, 'toDayEditOrders']);
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
    Route::post('/admin/allorders/deleteFileA', [AllOrdersController::class, 'deleteFileA'])->name('allorders.deleteFileA');
    Route::post('/admin/allorders/deleteFileB', [AllOrdersController::class, 'deleteFileB'])->name('allorders.deleteFileB');
    Route::post('/admin/allorders/send',[AllOrdersController::class,'sendEmailAndOrder'])->name('allorders.send');


    
    //for process page options


    //all vectors
    Route::resource('/admin/allvectors', AllVectorController::class);
    Route::get('/admin/allvectors/{id}/print', [AllVectorController::class, 'printOrder'])->name('allvectors.print');
    Route::get('/admin/today-vector', [AllVectorController::class, 'toDayVector']);
    Route::post('/admin/allvectors/{id}/allvector', [AllVectorController::class, 'assignDesigner'])->name('allvectors.allvector');
    Route::post('/admin/allvectors/addInstruction', [AllVectorController::class, 'storeInstruction'])->name('allvectors.addInstruction');
    Route::post('/admin/allvectors/adminInstruction', [AllVectorController::class, 'storeAdminInstruction'])->name('allvectors.adminInstruction');
    Route::post('/admin/allvectors/uploadFile', [AllVectorController::class, 'storeFile'])->name('allvectors.uploadFile');
    Route::post('/admin/allvectors/deleteFile', [AllVectorController::class, 'deleteFile'])->name('allvectors.deleteFile');
    Route::post('/admin/allvectors/updateStatus', [AllVectorController::class, 'orderStatus'])->name('allvectors.updateStatus');

    
    //option A B
    Route::post('/admin/allvectors/optionA', [AllVectorController::class, 'storeOptionA'])->name('allvectors.optionA');
    Route::post('/admin/allvectors/optionB', [AllVectorController::class, 'storeOptionB'])->name('allvectors.optionB');
    Route::post('/admin/allvectors/deleteFileA', [AllVectorController::class, 'deleteFileA'])->name('allvectors.deleteFileA');
    Route::post('/admin/allvectors/deleteFileB', [AllVectorController::class, 'deleteFileB'])->name('allvectors.deleteFileB');
    Route::get('/admin/allvectors/{id}/process',[AllVectorController::class,'processOrder'])->name('allvectors.process');
    Route::post('/admin/allvectors/send',[AllVectorController::class,'sendEmailAndOrder'])->name('allvectors.send');

    //invoices 
    Route::resource('/admin/invoices', InvoiceControlller::class);
    Route::get('/admin/invoice/{id}/download', [InvoiceControlller::class, 'downloadPDF'])->name('invoice.download');
    Route::get('/admin/invoice/{invoiceId}/fetch-details', [InvoiceControlller::class, 'fetchInvoiceDetails']);

    Route::post('/admin/invoice/{invoiceId}/update-status', [InvoiceControlller::class, 'updateInvoiceStatus'])->name('invoice.update-status');

    //all employees
    Route::resource('/admin/employees', EmployeeController::class);

    //asign leaders
    Route::resource('/admin/assign-leaders', AsignLeaderController::class);
    Route::post('/admin/assign-leaders/{id}/assign-leader', [AsignLeaderController::class, 'assignLeader'])->name('assign-leaders.assign-leader');


    /* digitizer */
    //quote worker

    Route::get('/quote-worker/dashboard', [WorkerDashboardController::class, 'index'])->name('quote-worker.dashboard');
    Route::resource('/quote-worker/all-worker-quotes', WorkerQuoteController::class);
    Route::get('/quote-worker/today-worker-quotes', [WorkerQuoteController::class, 'toDayQuote'])->name('quote-worker.today-quotes');
    Route::get('/quote-worker/all-worker-quotes/{id}/process', [WorkerQuoteController::class, 'showProcess'])->name('all-worker-quote.process');
    //quote leader
    Route::get('/quote-leader/dashboard', [QuoteLeaderDashboard::class, 'index'])->name('quote-leader.dashboard');
    Route::resource('/quote-leader/all-leader-quotes', LeaderQuoteController::class);
    Route::get('/quote-leader/today-leader-quotes', [LeaderQuoteController::class, 'toDayQuote'])->name('quote-leader.today-quotes');
    Route::get('/quote-leader/all-leader-quotes/{id}/process', [LeaderQuoteController::class, 'showProcess'])->name('all-leader-quote.process');

    //order worker
    Route::get('/order-worker/dashboard', [OrderWorkerDashboardController::class, 'index'])->name('order-worker.dashboard');
    Route::resource('/order-worker/all-worker-orders', WorkerOrderController::class);
    Route::get('/order-worker/today-worker-order', [WorkerOrderController::class, 'toDayOrders'])->name('order-worker.today-orders');
    Route::get('/order-worker/all-worker-order/{id}/process', [WorkerOrderController::class, 'showProcess'])->name('all-worker-orders.process');
    //order leader
    Route::get('/order-leader/dashboard', [OrderLeaderDashboardController::class, 'index'])->name('order-leader.dashboard');
    Route::resource('/order-leader/all-leader-orders', LeaderOrderController::class);
    Route::get('/order-leader/today-leader-order', [LeaderOrderController::class, 'toDayOrders'])->name('order-leader.today-leader-order');
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



    //support dashboard routing
    Route::get('/support/dashboard', [SupportDashboardController::class, 'index'])->name('support.dashboard');
    //support customers
    Route::resource('/support/supportcustomers', SupportCustomerController::class);
    Route::post('/support/supportcustomers/updateBill', [SupportCustomerController::class, 'updateBIlInfo'])->name('supportcustomer.updatedBill');
    Route::get('/support/allcustomers', [SupportCustomerController::class, 'allCustomer']);
    Route::get('/support/supportcustomers/{id}/billInfo',[SupportCustomerController::class,'billInfo'])->name('supportcustomers.billInfo');
    
    Route::get('/support/supportcustomers/{id}/addinvoice', [SupportCustomerController::class, 'addInvoice'])->name('supportcustomers.addinvoice');
    Route::post('/support/supportcustomers/storeinvoice', [SupportCustomerController::class, 'storeInvoice'])->name('supportcustomers.storeinvoice'); //customer panel profile from admin panel
    
      //pricing criteria
    Route::get('/support/pricing/{id}/support-pricing-details',[SupportCustomerController::class,'editPricingDetails'])->name('pricing.support-pricing-details');
    Route::post('/support/pricing/save/', [SupportCustomerController::class, 'updatePriceDetails'])->name('pricing.save');
    
    //vector details
    Route::get('/support/vectordetails/{id}/support-vector-details',[SupportCustomerController::class,'editVectorDetails'])->name('vectordetails.support-vector-details');
    Route::post('/support/vectordetails/save/',[SupportCustomerController::class,'updateVectorDetails'])->name('vectordetails.save');
    //support quotes
    Route::resource('/support/supportquotes',SupportQuotesController::class);
    Route::get('/support/support-todayquotes',[SupportQuotesController::class,'toDayQuote'])->name('supportquotes.support-todayquotes');
    Route::post('/support/supportquotes/deleteQuote',[SupportQuotesController::class,'deleteQuotes'])->name('supportquotes.deleteQuote');
    Route::get('/support/supportquotes/{id}/process', [SupportQuotesController::class, 'showProcess'])->name('supportquotes.process');
    Route::get('/support/supportquotes/{id}/print', [SupportQuotesController::class, 'printOrder'])->name('supportquotes.print');
    Route::post('/support/supportquotes/send',[SupportQuotesController::class,'sendEmailAndQuotes'])->name('supportquotes.send');
    //support orders
    Route::resource('/support/support-allorders', SupportOrdersController::class);
    Route::get('/support/support-today-orders', [SupportOrdersController::class, 'toDayOrders']);
    Route::get('/support/support-today-edit-orders', [SupportOrdersController::class, 'toDayEditOrders']);
    Route::get('/support/supportorders/{id}/process', [SupportOrdersController::class, 'processOrder'])->name('supportorders.process');
    Route::get('/support/supportorders/{id}/print', [SupportOrdersController::class, 'printOrder'])->name('supportorders.print');
    Route::post('/support/supportorders/deleteOrder',[SupportOrdersController::class,'deleteOrder'])->name('supportorders.deleteOrder');
    Route::post('/support/supportorders/send',[SupportOrdersController::class,'sendEmailAndOrder'])->name('supportorders.send');
    

    //support vector orders.
     Route::resource('/support/support-vector-orders', SupportVectorOrdersController::class);
     Route::get('/support/support-vector-today-orders', [SupportVectorOrdersController::class, 'toDayVector']);
     Route::post('/support/support-vector-orders/deleteOrder',[SupportVectorOrdersController::class,'deleteOrder'])->name('support-vector-orders.deleteOrder');
     Route::get('/support/support-vector-orders/{id}/process', [SupportVectorOrdersController::class, 'processOrder'])->name('support-vector-orders.process');
     Route::get('/support/support-vector-orders/{id}/print', [SupportVectorOrdersController::class, 'printOrder'])->name('support-vector-orders.print');
     Route::post('/support/support-vector-orders/send',[SupportVectorOrdersController::class,'sendEmailAndOrder'])->name('support-vector-orders.send');
     //support employee add
     //all employees
    Route::resource('/support/suppport-employees', SupportEmployeeController::class);
    Route::resource('/support/suppport-invoices', SupportInvoiceController::class);

    //design & leaders
    Route::resource('/support/support-assign-leader', SupportAssignLeaderController::class);
    


    //accounts dashboard routing
    Route::get('/accounts/dashboard', [AccounsDashboardController::class, 'index'])->name('accounts.dashboard');
    Route::resource('/accounts/accounts-customers',AccountCustomerController::class);
    Route::get('/accounts/allcustomers',[AccountCustomerController::class,'allCustomer']);
    Route::get('/accounts/accounts-customers/{id}/billInfo',[AccountCustomerController::class,'billInfo'])->name('accounts-customers.billInfo');
    Route::get('/accounts/accounts-customers/{id}/pricing-details',[AccountCustomerController::class,'editPricingDetails'])->name('accounts-customers.pricing-details');
    Route::get('/accounts/accounts-customers/{id}/vector-details',[AccountCustomerController::class,'editVectorDetails'])->name('accounts-customers.vector-details');
   
    Route::get('/accounts/accounts-customers/{id}/addinvoice', [AccountCustomerController::class, 'addInvoice'])->name('accounts-customers.addinvoice');
    Route::resource('/accounts/accounts-invoices', AccountInvoiceController::class);


    //accounts quotes routing
    Route::resource('/accounts/account-allquotes',AccountQuotesController::class);
    Route::get('/accounts/account-todayquotes',[AccountQuotesController::class,'toDayQuote'])->name('accounts.account-todayquotes');
    Route::get('/accounts/accountquotes/{id}/process', [AccountQuotesController::class, 'showProcess'])->name('accountquotes.process');
    Route::get('/accounts/accountquotes/{id}/print', [AccountQuotesController::class, 'printOrder'])->name('accountquotes.print');
  
    //accounts orders routing
    Route::resource('/accounts/account-allorders',AccountOrdersController::class);
    Route::get('/accounts/account-today-orders',[AccountOrdersController::class,'toDayOrders'])->name('accounts.account-today-orders');
    Route::get('/accounts/account-today-edit-orders',[AccountOrdersController::class,'toDayEditOrders'])->name('accounts.account-today-edit-orders');
    Route::get('/accounts/accountorders/{id}/process', [AccountOrdersController::class, 'processOrder'])->name('accountorders.process');
    Route::get('/accounts/accountorders/{id}/print', [AccountOrdersController::class, 'printOrder'])->name('accountorders.print');
  //  Route::post('/accounts/accountorders/deleteOrder',[SupportOrdersController::class,'deleteOrder'])->name('supportorders.deleteOrder');
   
    //accounts vector order routing
    
    Route::resource('/accounts/account-allvectors',AccountVectorOrdersController::class);
    Route::get('/accounts/account-today-vector', [AccountVectorOrdersController::class, 'toDayVector']);
    
    Route::get('/accounts/account-vector-orders/{id}/process', [AccountVectorOrdersController::class, 'processOrder'])->name('account-vector-orders.process');
    Route::get('/accounts/account-vector-orders/{id}/print', [AccountVectorOrdersController::class, 'printOrder'])->name('account-vector-orders.print');
    
    //employee add
    Route::resource('/accounts/account-employees',AccountEmployeeController::class);


    //assign leader accounts
    Route::resource('/accounts/accounts-assign-leader',AccountAssignLeaderController::class);

   
    //sales panel routing
    
    Route::get('/sales/dashboard', [SalesDashboardController::class, 'index'])->name('sales.dashboard');
    //customer sales panel
    Route::resource('/sales/sales-customers',SalesCustomerController::class);
    Route::get('/sales/allcustomers', [SalesCustomerController::class, 'allCustomer']);
    Route::get('/sales/sales-customers/{id}/billInfo',[SalesCustomerController::class,'billInfo'])->name('sales-customers.billInfo');
    Route::get('/sales/sales-customers/{id}/pricing-details',[SalesCustomerController::class,'editPricingDetails'])->name('sales-customers.pricing-details');
    Route::get('/sales/sales-customers/{id}/vector-details',[SalesCustomerController::class,'editVectorDetails'])->name('sales-customers.vector-details');
   
    Route::get('/sales/sales-customers/{id}/addinvoice', [SalesCustomerController::class, 'addInvoice'])->name('sales-customers.addinvoice');
    Route::resource('/sales/sales-invoices', SalesCustomerController::class);


    //quotes sales panel
    Route::resource('/sales/sales-allquotes',SalesAllQuotesController::class);
    Route::get('/sales/sales-todayquotes',[SalesAllQuotesController::class,'toDayQuote'])->name('sales.sales-todayquotes');
    // Route::post('/support/supportquotes/deleteQuote',[SupportQuotesController::class,'deleteQuotes'])->name('supportquotes.deleteQuote');
    Route::get('/sales/salesquotes/{id}/process', [SalesAllQuotesController::class, 'showProcess'])->name('salesquotes.process');
    Route::get('/sales/salesquotes/{id}/print', [SalesAllQuotesController::class, 'printOrder'])->name('salesquotes.print');
    // Route::post('/support/supportquotes/send',[SupportQuotesController::class,'sendEmailAndQuotes'])->name('supportquotes.send');
    

    //orders sales panel
    Route::resource('/sales/sales-allorders', SalesOrdersController::class);
    Route::get('/sales/sales-today-orders', [SalesOrdersController::class, 'toDayOrders']);
    Route::get('/sales/sales-today-edit-orders', [SalesOrdersController::class, 'toDayEditOrders']);
    Route::get('/sales/salesorders/{id}/process', [SalesOrdersController::class, 'processOrder'])->name('salesorders.process');
    Route::get('/sales/salesorders/{id}/print', [SalesOrdersController::class, 'printOrder'])->name('salesorders.print');
    // Route::post('/support/supportorders/deleteOrder',[SupportOrdersController::class,'deleteOrder'])->name('supportorders.deleteOrder');
    // Route::post('/support/supportorders/send',[SupportOrdersController::class,'sendEmailAndOrder'])->name('supportorders.send');


    // vector order sales panel.
     Route::resource('/sales/sales-allvectors', SalesAllVectorsController::class);
     Route::get('/sales/sales-today-vectors', [SalesAllVectorsController::class, 'toDayVector']);
    //  Route::post('/support/support-vector-orders/deleteOrder',[SalesAllVectorsController::class,'deleteOrder'])->name('support-vector-orders.deleteOrder');
     Route::get('/sales/sales-vector-orders/{id}/process', [SalesAllVectorsController::class, 'processOrder'])->name('sales-vector-orders.process');
     Route::get('/sales/sales-vector-orders/{id}/print', [SalesAllVectorsController::class, 'printOrder'])->name('sales-vector-orders.print');
    //  Route::post('/support/support-vector-orders/send',[SalesAllVectorsController::class,'sendEmailAndOrder'])->name('support-vector-orders.send');
    
    //  //sales employee add
     //all employees
    Route::resource('/sales/sales-employees', SalesEmployeeController::class);
    Route::resource('/sales/sales-invoices', SalesInvoiceController::class);
    //assign leader
    Route::resource('/sales/sales-assign-leader', SalesAssignLeaderController::class);


    //reports 
    Route::get('/reports/sales-team', [SalesTeamReportController::class, 'index'])->name('reports.sales-team');
    Route::get('/reports/sales-team/result',[SalesTeamReportController::class,'searchSalesTeam'])->name('sales-team.result');
    Route::get('/reports/record-annum', [RecordAnnumController::class, 'index'])->name('reports.record-annum');
    Route::get('/reports/record-annum/result',[RecordAnnumController::class,'searchRecordAnnum'])->name('record-annum.result');
    Route::get('/reports/sales-annum', [SalesAnnumController::class, 'index'])->name('reports.sales-annum');
    Route::get('/reports/sales-annum/result',[SalesAnnumController::class,'searchSalesAnnum'])->name('sales-annum.result');
    Route::get('/reports/designer-report', [DesignReportController::class, 'index'])->name('reports.designer-report');
    Route::get('/reports/designer-report/result',[DesignReportController::class,'searchDesignerReport'])->name('designer-report.result');
    Route::get('/reports/account-report', [AccountsReportController::class, 'index'])->name('reports.account-report');
    Route::get('/reports/account-report/result',[AccountsReportController::class,'searchDesignerReport'])->name('account-report.result');
   
    
    

});
/*end admin routing  */




require __DIR__ . '/auth.php';
