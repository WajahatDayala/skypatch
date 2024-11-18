<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CardType;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\CustomerBillInfo;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = Country::all();
        $cardType = CardType::all();
        return view('auth.register',['countries'=>$countries,'cardType'=>$cardType]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'showing_password' => $request->password,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'cell' => $request->cell,
            'fax' => $request->fax,
            'email_2' => $request->email2,
            'email_3' => $request->email3,
            'email_4' => $request->email4,
            'invoice_email' => $request->invoice_email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'reference' =>$request->reference,

        ]);

        event(new Registered($user));

        Auth::login($user);

          // Create the Billing Info
    $billInfo = new CustomerBillInfo(); // Assume BillingInfo is the model
    $billInfo->customer_id = $user->id;
    $billInfo->card_holder_name = $request['card_holder_name'];
    $billInfo->card_type_id = $request['card_type'];
    $billInfo->card_number = $request['credit_number'];
    $billInfo->card_expiry = $request['billing_exp_month'] . '/' . $request['billing_exp_year'];
    $billInfo->vcc = $request['verification_num'];
    $billInfo->address = $request['address'];
    $billInfo->city = $request['city'];
    $billInfo->state = $request['state'];
    $billInfo->zipcode = $request['zipcode'];
    $billInfo->country = $request['countrybill']; // Store the selected billing country

    $billInfo->save();


        return redirect(route('dashboard', absolute: false));
    }
}
