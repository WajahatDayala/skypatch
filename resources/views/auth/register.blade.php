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


<div class="header">
    <!-- Logo -->
    <img class="logo" src="{{asset('skypatch/img/logowhite.png')}}" alt="Logo">
    <!-- Sign In Text -->
    <p class="text">REGISTRATION</p>
  </div>

  <div class="main-container">
    <div class="container">
      <h1 class="text-style-4">Welcome Back to SkyPatch and Digitizers!</h1>
      <p>Free Registration to manage your orders, track progress, and collaborate on your designs.</p>
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
              <p class="text-5 text-style-3">Free Registration</p>
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                <div class="form-group">
              
                    <x-text-input class="form-control" id="name" type="text" placeholder="Name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
               </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-text-input class="form-control" id="contact_name" placeholder="Contact Person" type="text" name="contact_name" :value="old('contact_name')" required autofocus autocomplete="contact_name" />
                        <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <x-text-input class="form-control" id="companyName" placeholder="Company Name" type="text" name="company_name" :value="old('company_name')" required autocomplete="company-name" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-text-input class="form-control" id="phone" type="text" name="phone" placeholder="Phone*" :value="old('phone')" required autocomplete="tel" />
                         <x-input-error :messages="$errors->get('phone')" class="mt-2" />
       
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <x-text-input class="form-control" id="cell" type="text" placeholder="Cell" name="cell" :value="old('cell')" />
                        <x-input-error :messages="$errors->get('cell')" class="mt-2" />
                        
                    </div>
                </div>
            </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <x-text-input class="form-control" id="fax" type="text" name="fax" placeholder="Fax" :value="old('fax')" />
                <x-input-error :messages="$errors->get('fax')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="email" type="email" placeholder="Email Address 1*" name="email" :value="old('email')" required autocomplete="username" />
                    
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" placeholder="Email Address 2" id="email1" type="email" name="email1" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="email2" placeholder="Email Address 3" type="email" name="email3" />
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <x-text-input class="form-control" placeholder="Email Address 4" id="email4" type="email" name="email4" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <x-text-input class="form-control" placeholder="Invoice Email" id="invoice_email" type="email" name="email4" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="address" placeholder="Address*" type="text" name="address" :value="old('address')" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="city" type="text" placeholder="City*" name="city" :value="old('city')" required />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                        <x-text-input class="form-control" id="state" type="text" placeholder="State" name="state" :value="old('state')" required />
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="zipcode" type="text" placeholder="Zipcode" name="zipcode" :value="old('zipcode')" required />
                    <x-input-error :messages="$errors->get('zipcode')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control bg-white" name="country" required>
                        <option value="" disabled selected>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <x-text-input class="form-control" id="username" type="text" placeholder="Username*" name="username" :value="old('username')" required autocomplete="username" />
                     <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
            </div>
        </div>


       

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="password" placeholder="Password*" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <x-text-input class="form-control" id="password_confirmation" type="password" placeholder="Confirm Password*" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control bg-white" name="reference" required>
                        <option value="" disabled selected>Select Reference</option>
                        <option>Search Engine</option>
                        <option>Sales Man</option>
                        <option>Customer Reference</option>
                        <option>Others</option>
                    </select>
                   
                    <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                </div>
            </div>
        </div>

        


                <div class="col-md-12">
                    <button type="submit"  class="btn btn-block mt-4">Register</button>
                </div>
                
              </form>

              <p class="text-9">Don't have an Account? <a  href="{{ route('login') }}" class="text-style-4">Already registered?</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

</x-guest-layout>