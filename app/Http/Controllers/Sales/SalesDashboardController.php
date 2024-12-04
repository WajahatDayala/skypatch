<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdminAuthController; // Correct import
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SalesDashboardController extends Controller
{
    //
    public function index(){
        if (!Auth::guard('admin')->check()) {
            return redirect('/admin/login'); // Redirect to login if not authenticated
        }
    
        return view('sales.dashboard'); // Render dashboard view
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    
        $user = $request->user();
    
        Auth::guard('admin')->logout(); // Ensure you're using the correct guard
    
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token
    
        return redirect('/admin/login'); // Redirect after logout
    }
}
