<?php

namespace App\Http\Controllers\Digitizer\Order\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminAuthController; // Correct import
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrderWorkerDashboardController extends Controller
{
    //
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/admin/login'); // Redirect to login if not authenticated
        }
    
        return view('digitizer.order-worker.dashboard'); // Render dashboard view
        
    }
}
