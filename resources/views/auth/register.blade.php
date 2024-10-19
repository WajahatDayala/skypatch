<x-guest-layout>

<div class="container-xxl position-relative bg-white d-flex p-0">
    <div class="container-fluid bg-img">
            <div class="row h-100  justify-content-center" style="min-height: 100vh;">
                <div class="d-sm-none d-lg-block col-lg-6 pt-4 px-5 text-container">
                    <div class="text-white">
                        <h1 class="h2 text-white">Welcome Back to SkyPatch and Digitizers!</h1>
                        <p class="text-white px-4 fs-6 ">
                            Sign in to manage your orders, track progress, and collaborate on your designs.

                        <h5 class="text-white px-4">What You Can Do:</h5>
                        <ul class="text-white px-4">
                            <li><strong>Access Your Dashboard:</strong> View and manage your orders in one place.</li>
                            <li><strong>Fast & Secure Payments:</strong> View and manage your orders in one place.</li>
                            <li><strong>Track Order Progress:</strong> Follow every step of your order’s journey.</li>
                            <li><strong>Upload & Receive Files:</strong> Securely upload and receive design files.</li>
                        </ul>
                        </p>
                    </div>
                </div>



    <!--form--><!--form-->
        <div class="col-sm-12 col-lg-6 login-container">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <img src="{{asset('skypatch/img/logo_resized.png')}}" alt="" width="100px">
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-label for="name" :value="__('Name')" />
    </div>

    <!-- contact Person -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="contact_name" type="text" name="contact_name" :value="old('contact_name')" required autofocus autocomplete="contact_name" />
        <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
        <x-input-label for="contact_name" :value="__('Contact Person')" />
    </div>

    <!-- Company Name -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="companyName" type="text" name="company_name" :value="old('company_name')" required autocomplete="company-name" />
        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        <x-input-label for="company_name" :value="__('Company Name')" />
    </div>

     <!-- Company Type -->
     <div class="form-floating mb-3">
        <select class="form-control" name="company_type" required>
            <option value="" disabled selected>Select Company Type</option>
            <option value="Embroider">Embroider</option>
            <option value="Distributor">Distributor</option>
            <option value="Promotional">Promotional</option>
            <option value="Marketing">Marketing</option>
            <option value="Manufacturers">Manufacturers</option>
            <option value="Uniform/Apparels">Uniform/Apparels</option>
            <option value="Others">Others</option>
        </select>
        <x-input-label for="company_type" :value="__('Company Type')" />
        <x-input-error :messages="$errors->get('company_type')" class="mt-2" />
    </div>

    <!-- Phone -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="phone" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        <x-input-label for="phone" :value="__('Phone*')" />
    </div>

    <!-- Cell -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="cell" type="text" name="cell" :value="old('cell')" />
        <x-input-error :messages="$errors->get('cell')" class="mt-2" />
        <x-input-label for="cell" :value="__('Cell')" />
    </div>

    <!-- Fax -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="fax" type="text" name="fax" :value="old('fax')" />
        <x-input-error :messages="$errors->get('fax')" class="mt-2" />
        <x-input-label for="fax" :value="__('Fax')" />
    </div>

    <!-- Email Address 1 -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-label for="email" :value="__('Email Address 1*')" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

     <!-- Email Address 3 -->
     <div class="form-floating mb-3">
        <x-text-input class="form-control" id="email1" type="email1" name="email1" />
        <x-input-label for="email1" :value="__('Email Address 2')" />
    </div>

      <!-- Email Address 2 -->
      <div class="form-floating mb-3">
        <x-text-input class="form-control" id="email2" type="email2" name="email3" />
        <x-input-label for="email2" :value="__('Email Address-3')" />
    </div>

     <!-- Email Address 4 -->
     <div class="form-floating mb-3">
        <x-text-input class="form-control" id="email4" type="email4" name="email4" />
        <x-input-label for="email4" :value="__('Email Address-4')" />
    </div>

    

   

    <!-- Address Fields -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="address" type="text" name="address" :value="old('address')" required />
        <x-input-error :messages="$errors->get('address')" class="mt-2" />
        <x-input-label for="address" :value="__('Address')" />
    </div>

    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="city" type="text" name="city" :value="old('city')" required />
        <x-input-error :messages="$errors->get('city')" class="mt-2" />
        <x-input-label for="city" :value="__('City')" />
    </div>

    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="state" type="text" name="state" :value="old('state')" required />
        <x-input-error :messages="$errors->get('state')" class="mt-2" />
        <x-input-label for="state" :value="__('State')" />
    </div>

    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="zipcode" type="text" name="zipcode" :value="old('zipcode')" required />
        <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
        <x-input-label for="zipcode" :value="__('Zipcode')" />
    </div>

    <div class="form-floating mb-3">
        <select class="form-control" name="country" required>
            <option value="" disabled selected>Select Country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->name }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <x-input-label for="country" :value="__('Select Country')" />
        <x-input-error :messages="$errors->get('country')" class="mt-2" />
    </div>

    <!-- Username -->
    <div class="form-floating mb-3">
        <x-text-input class="form-control" id="username" type="text" name="username" :value="old('username')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
        <x-input-label for="username" :value="__('Username*')" />
    </div>

    <!-- Password -->
    <div class="form-floating mb-4">
        <x-text-input class="form-control" id="password" type="password" name="password" required autocomplete="new-password" />
        <x-input-label for="password" :value="__('Password*')" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="form-floating mb-4">
        <x-text-input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-label for="password_confirmation" :value="__('Confirm Password*')" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Reference -->
    <div class="form-floating mb-3">
        <select class="form-control" name="reference" required>
            <option value="" disabled selected>Select Reference</option>
            <option>Search Engine</option>
            <option>Sales Man</option>
            <option>Customer Reference</option>
            <option>Others</option>
        </select>
        <x-input-label for="reference" :value="__('Reference')" />
        <x-input-error :messages="$errors->get('reference')" class="mt-2" />
    </div>

   


    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="btn btn-primary py-3 w-100 mb-4">
            {{ __('Register') }}
        </x-primary-button>
        <p class="text-center mb-0">Don't have an Account?  
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </p>
    </div>
</form>



<!--end form-->

     </div>


</div>
</x-guest-layout>