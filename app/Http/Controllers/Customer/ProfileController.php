<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::select('*')
        ->where('id',Auth::id())
        ->first();
        return view('customer.profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        return view('customer.profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'cell' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'email_1' => 'required|email|max:255', // New required email field
            'email_2' => 'nullable|email|max:255',
            'email_3' => 'nullable|email|max:255',
            'email_4' => 'nullable|email|max:255',
            'password' => 'nullable|string|min:8', // Validate password
        ]);
        
        $user = User::findOrFail($id);
        
        // Update fields except email
        $user->name = $validatedData['name'];
        $user->contact_name = $validatedData['contact_name'];
        $user->company_name = $validatedData['company_name'];
        $user->company_type = $validatedData['company_type'];
        $user->phone = $validatedData['phone'];
        $user->cell = $validatedData['cell'];
        $user->fax = $validatedData['fax'];
        $user->address = $validatedData['address'];
        $user->city = $validatedData['city'];
        $user->state = $validatedData['state'];
        $user->zipcode = $validatedData['zipcode'];
        $user->country = $validatedData['country'];
        
        // Update email fields
        $user->email_1 = $validatedData['email_1'];
        $user->email_2 = $validatedData['email_2'];
        $user->email_3 = $validatedData['email_3'];
        $user->email_4 = $validatedData['email_4'];
        
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']); // Hash the new password
        }
        
        $user->save();
        
        return redirect()->route('my-profile.index')->with('success', 'Profile updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
