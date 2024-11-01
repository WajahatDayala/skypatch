<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;

use App\Models\CustomerBillInfo;
use App\Models\CardType;


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

            
        $billInfo = CustomerBillInfo::select('*','card_types.name as cardType')
        ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
        ->where('customer_bill_infos.customer_id',Auth::id())
        ->first();
    
        return view('customer.profile.index',compact('user','billInfo'));
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
        $country = Country::all();
        return view('customer.profile.edit',compact('user','country'));
    }

    public function billInfo(string $id)
    {
        $country  = Country::all();
        $cardType = CardType::all();
        $user = User::select('*','users.id')
        ->leftjoin('customer_bill_infos','customer_bill_infos.customer_id','=','users.id')
        ->leftjoin('card_types','customer_bill_infos.card_type_id','=','card_types.id')
        ->where('users.id',$id)
        ->first();

       
        return view('customer.bill-details.edit',
        compact('user','country','cardType'));
    
    

    }

    public function storeBillInfo(Request $request)
    {
        $validatedData = $request->validate([
            'card_holder_name' => 'required|string|max:255',
            'card_type' => 'required', // Make sure this matches your input name
            'credit_number' => 'required',
            'billing_exp_month' => 'required',
            'billing_exp_year' => 'required',
            'verification_num' => 'required',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);
    
        $user  = User::findOrFail($request->customer_id);
        
          // Check if the billing info exists or create a new instance
        $billInfo = CustomerBillInfo::firstOrNew(['customer_id' => $user->id]);
        $billInfo->card_holder_name = $validatedData['card_holder_name'];
        $billInfo->card_type_id = $validatedData['card_type'];
        $billInfo->card_number = $validatedData['credit_number'];
        $billInfo->card_expiry = $validatedData['billing_exp_month'] . '/' . $validatedData['billing_exp_year'];
        $billInfo->vcc = $validatedData['verification_num'];
        $billInfo->address = $validatedData['address'];
        $billInfo->city = $validatedData['city'];
        $billInfo->state = $validatedData['state'];
        $billInfo->zipcode = $validatedData['zipcode'];
        $billInfo->country = $validatedData['country'];

       
      
        $billInfo->save();
        return redirect()->back()->with('success', 'Added updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' =>'required|string|max:255',
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
            'email_2' => 'nullable|string|max:255', // New required email field
            'email_3' => 'nullable|string|max:255',
            'email_4' => 'nullable|string|max:255',
            'invoice_email' =>'nullable|string|max:255',
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
        $user->email_2 = $validatedData['email_2'];
        $user->email_3 = $validatedData['email_3'];
        $user->email_4 = $validatedData['email_4'];
        $user->invoice_email = $validatedData['invoice_email'];
        
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']); // Hash the new password
            $user->showing_password = $validatedData['password'];
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
