<x-guest-layout>

    <style>
        body {
          font-family: 'Montserrat', sans-serif;
          background-color: #f0f0f0;
          margin: 0;
          padding: 0;
        }
  
        .main-container {
          padding: 50px 0;
        }
  
      ul li {
    color: #283071; /* Optional: Color for the text */
  }
  
  ul li::marker {
    color: #d71f36; /* Change bullet color to red */
  }
       
  
        .header {
          background-color: #283071;
          color: #fff;
          padding: 10px 0;
          display: flex;
          justify-content: space-between;
          align-items: center;
          flex-wrap: nowrap; /* Prevents items from wrapping */
        }
  
        .header .logo {
          width: 175px;
          height: 128px;
          margin-left: 14%; /* Adjusted margin for proper positioning */
        }
  
        .header .text {
          font-size: 2.6rem;
          font-weight: bold;
          text-transform: uppercase;
          margin: 0;
          padding: 20px;
          margin-right: 14%; /* Adjusted margin for proper spacing */
        }
  
        /* Responsiveness: Keep layout same on smaller screens */
        @media (max-width: 768px) {
          .header {
            padding: 10px 0;
            justify-content: space-between; /* Keeps the same space distribution */
          }
  
          .header .logo {
            width: 140px; /* Slightly reduce logo size for mobile */
            height: 100px;
          }
  
          .header .text {
            font-size: 2.2rem; /* Reduce text size for better fitting */
          }
        }
  
        .footer {
          background-color: #ececec;
          padding: 30px;
          border-radius: 14px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
  
        .footer .text-5 {
          font-size: 2.375rem;
          font-weight: bold;
          margin-bottom: 20px;
        }
  
        .footer .form-group {
          margin-bottom: 20px;
        }
  
        .footer .form-control {
        
          height: 55px;
          font-size: 1.2rem;
        }
  
        .footer .btn {
          
          padding: 15px 30px;
          font-size: 1.2rem;
          background-color: #d71f36;
          color: #fff;
        }
  
        .footer .btn:hover {
          background-color: #b61b2e;
        }
  
        .text-style-4 {
          color: #283071;
          font-weight: bold;
        }
  
        .text-style-3 {
          color: #283071;
          font-weight: 600;
        }
  
        .text-style-2 {
          color: #212121;
          font-weight: 500;
        }
  
        .footer .text-9 {
          margin-top: 30px;
          text-align: left;
          color: #8e8e8e;
        }
        .btn{
            width: 100%;
        }
      </style>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="header">
        <!-- Logo -->
        <img class="logo" src="{{asset('skypatch/img/logowhite.png')}}" alt="Logo">
        <!-- Sign In Text -->
        <p class="text">Sign in</p>
      </div>

      <div class="main-container">
        <div class="container">
          <h1 class="text-style-4">Welcome Back to SkyPatch and Digitizers!</h1>
          <p>Sign in to manage your orders, track progress, and collaborate on your designs.</p>
          <h2>What You Can Do:</h2>
          <ul>
            <li><span class="text-style-3">Access Your Dashboard:</span> <span class="text-dark">View and manage your orders in one place.</span></li>
            <li><span class="text-style-3">Track Order Progress:</span> <span class="text-dark">Follow every step of your order’s journey.</span></li>
            <li><span class="text-style-3">Upload & Receive Files:</span> <span class="text-dark">Securely upload and receive design files.</span></li>
          </ul>
        </div>


        <div class="container">
            <div class="row mt-4 justify-content-center">
              <div class="col-md-12">
                <div class="footer w-100">
                  <p class="text-5 text-style-3">Sign In</p>
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
                    <div class="form-group">
                      {{-- <label for="username">Username</label> --}}
                      {{-- <input type="text" id="username" class="form-control" placeholder="Enter your username"> --}}

                      <x-text-input
                      class="form-control"
                      type="text"
                      name="username"
                      :value="old('username')"
                      required
                      autofocus
                      autocomplete="username"
                      placeholder="Username" 
                  />
                  <x-input-error :messages="$errors->get('username')" class="mt-2" />
                  {{-- <x-input-label for="username" :value="__('Username')" /> --}}

                    </div>
                    <div class="form-group">
                      
                      <x-text-input class="form-control"
                      type="password"
                      name="password"
                      required autocomplete="current-password" placeholder="Password"  />

                     <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>
                    <div class="form-check">
                    
                      <input  type="checkbox"  class="form-check-input" id="rememberMe" name="remember">
                      <span class="form-check-label">{{ __('Remember me') }}</span>

                      @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}" class="float-right">Forgot your password?</a>
                      @endif
                    
                    </div>
    
                    <div class="col-md-12">
                        <button type="submit"  class="btn btn-block mt-4">Log in</button>
                    </div>
                    
                  </form>
    
                  <p class="text-9">Don't have an Account? <a href="/register" class="text-style-4">Sign Up</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>

</x-guest-layout>
