<x-guest-layout>

<div class="container-xxl position-relative bg-white d-flex p-0">
    <div class="container-fluid bg-img">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="d-sm-none d-lg-block col-lg-6 px-5 text-container">
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
                            <h3>Sign In</h3>
                        </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-floating mb-3">
            
            <x-text-input  class="form-control" id="floatingInput" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-label for="name" :value="__('Name')" />    
        </div>

        <!-- Email Address -->
        <div class="form-floating mb-3">
          
            <x-text-input  class="form-control" id="floatingInput" placeholder="Email"  type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-label for="email" :value="__('Email')" /> 
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-floating mb-4">
            
            <x-text-input class="form-control" id="floatingPassword" 
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-label for="password" :value="__('Password')" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-floating mb-4">
         

            <x-text-input class="form-control" id="floatingPassword" 
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div hidden class=" form-floating mb-4">
           

            <select class="form-control" name="customer">
                <option value="customer">Customer</option>
            </select>
       </div>

       <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="btn btn-primary py-3 w-100 mb-4">
                {{ __('Register') }}
            </x-primary-button>
           

                <p class="text-center mb-0">Don't have an Account?  <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a></p>
        </div>


        
</form>


<!--end form-->

     </div>


</div>
</x-guest-layout>
