<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin; // Ensure this is the correct model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login'); // Adjust this path if your view is located elsewhere
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate using the username and password
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed
            return $this->redirectToRoleDashboard(Auth::guard('admin')->user());
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function redirectToRoleDashboard($admin)
    {
        // Check if the admin has a role
        if ($admin->role) {
            switch ($admin->role->name) { // Access the role directly if it's a single role relationship
                case 'Admin':
                    return redirect()->route('admin.dashboard'); // Admin Dashboard
                case 'Customer Support':
                    return redirect()->route('support.dashboard'); // Support Dashboard
                case 'Sales':
                    return redirect()->route('sales.dashboard'); // Sales Dashboard
                case 'Accounts':
                    return redirect()->route('accounts.dashboard'); // Accounts Dashboard
                case 'Quote Leader':
                    return redirect()->route('quote-leader.dashboard'); // Quote Leader Dashboard
                case 'Quote Worker':
                    return redirect()->route('quote-worker.dashboard'); // Quote Worker Dashboard
                case 'Order Leader':
                    return redirect()->route('order-leader.dashboard'); // Order Leader Dashboard
                case 'Order Worker':
                    return redirect()->route('order-worker.dashboard'); // Order Worker Dashboard
                case 'Vector Leader':
                    return redirect()->route('vector-leader.dashboard'); // Vector Leader Dashboard
                case 'Vector Worker':
                    return redirect()->route('vector-worker.dashboard'); // Vector Worker Dashboard
                default:
                    return redirect('/admin/login'); // Fallback
            }
        }

        return redirect('/admin/login'); // Redirect if no role is found
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
       // session()->flush(); // Clear all session data
        return redirect('/admin/login'); // Redirect to admin login after logout
    }   

   
}
