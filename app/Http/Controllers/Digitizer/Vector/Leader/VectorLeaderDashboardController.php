<?php

namespace App\Http\Controllers\Digitizer\Vector\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminAuthController; // Correct import
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VectorLeaderDashboardController extends Controller
{
    //
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect('/admin/login'); // Redirect to login if not authenticated
        }
    
        return view('digitizer.vector-leader.dashboard'); // Render dashboard view
        
    }
    
}
