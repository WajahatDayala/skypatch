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
                    return redirect()->route('support.index'); // Support Dashboard
                case 'Sales':
                    return redirect()->route('sales.index'); // Sales Dashboard
                case 'Accounts':
                    return redirect()->route('accounts.index'); // Accounts Dashboard
                case 'Quote Digitizer Leader':
                    return redirect()->route('quote.leader.index'); // Quote Leader Dashboard
                case 'Quote Digitizer Worker':
                    return redirect()->route('quote.worker.index'); // Quote Worker Dashboard
                case 'Order Digitizer Leader':
                    return redirect()->route('order.leader.index'); // Order Leader Dashboard
                case 'Order Digitizer Worker':
                    return redirect()->route('order.worker.index'); // Order Worker Dashboard
                case 'Vector Digitizer Leader':
                    return redirect()->route('vector.leader.index'); // Vector Leader Dashboard
                case 'Vector Digitizer Worker':
                    return redirect()->route('vector.worker.index'); // Vector Worker Dashboard
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
