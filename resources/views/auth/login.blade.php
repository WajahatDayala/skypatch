<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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

        <!--form-->
        <div class="col-sm-12 col-lg-6 login-container">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <img src="{{asset('skypatch/img/logo_resized.png')}}" alt="" width="100px">
                            </a>
                            <h3>Sign In</h3>
                        </div>


            <!--form-->
            <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <!-- <div class="form-floating mb-3">
           
            <x-text-input  class="block mt-1 w-full" 
            class="form-control" id="floatingInput"
            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2"  />
            <x-input-label for="email" :value="__('Email')" />
        </div> -->

        <!-- Username -->
        <div class="form-floating mb-3">
                                <x-text-input
                                    class="form-control block mt-1 w-full"
                                    id="floatingInput"
                                    type="text"
                                    name="username"
                                    :value="old('username')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Username" 
                                />
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                <x-input-label for="username" :value="__('Username')" />
                            </div>

        <!-- Password -->
        <div class="form-floating mb-4">
           

            <x-text-input class="form-control" id="floatingPassword"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-label for="password" :value="__('Password')" />
        </div>

        

        <!-- Remember Me -->
        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
            <label for="remember_me" class="inline-flex items-center">
                <input  type="checkbox"  class="form-check-input" id="exampleCheck1" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
    </div>

        <div class="flex items-center justify-end mt-4">
           

            <x-primary-button class="btn btn-primary py-3 w-100 mb-4">
                {{ __('Log in') }}
            </x-primary-button>
            <p class="text-center mb-0">Don't have an Account? <a href="/register">Sign Up</a></p>
        </div>

        



    </form>
            <!--end form -->


        </div>

        <!--end form-->



    <!--form-->

    </div>
</x-guest-layout>
