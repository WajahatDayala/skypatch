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

        .text-style-1 {
          color: #283071;
          font-weight: 400;
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
                <x-text-input class="form-control" placeholder="Invoice Email" id="invoice_email" type="email" name="invoice_email" />
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
                    <select class="form-control bg-white" id="country" name="country" required>
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

        <div class="row">
        <!-- Checkbox -->
        <div class="col-md-6">
          Update Billing Info Click Here <input type="checkbox" id="toggleCheckbox"> 
        </div>
      </div>

      <!-- Div to be shown/hidden -->
      <div id="details" style="display: none;">
        <p class="text-5 text-style-1">Billing Info</p>
       <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <x-text-input class="form-control" id="card_holder_name" type="text" placeholder="Cardholder's Name" name="card_holder_name"  required autofocus autocomplete="card_holder_name" />
          </div>
        </div>
       </div>

       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
           <select class="form-control form-control-sm bg-white" name="card_type" id="card_type" aria-label="Default select example" onchange="validateCardNumber()">
            <option value="" selected class='text-gray'>Select Card Type</option>
            @foreach($cardType as $t)
            <option value="{{ $t->id }}">
                {{ $t->name }}
            </option>
            @endforeach
        </select>
       </div>
      </div>
      
      <div class="col-md-6">
       <div class="form-group">
        <x-text-input type="text" name="credit_number" placeholder="Credit Card Number" class="form-control" id="credit_number" />

        
      </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          @php
// Assuming the saved value is stored in a variable
$savedValue = ''; // Example saved value

// Initialize variables to avoid "undefined variable" errors
$month = '';
$year = '';

// Check if the saved value is not empty and contains a '/'
if (!empty($savedValue) && strpos($savedValue, '/') !== false) {
    list($month, $year) = explode('/', $savedValue);
    
    // Check if both month and year were successfully extracted
    if (!isset($month) || !isset($year)) {
        // Handle the case where month or year is not set
        echo "Invalid expiry date format.";
    }
} else {
    // Handle the case where savedValue is empty or not in the expected format
    echo "";
}
@endphp

<select class="form-control form-control-limit form-control-sm bg-white" id="billing_exp_month" name="billing_exp_month">
  <option value="">Select Month</option>
  <option value="1" {{ $month == 1 ? 'selected' : '' }}>January</option>
  <option value="2" {{ $month == 2 ? 'selected' : '' }}>February</option>
  <option value="3" {{ $month == 3 ? 'selected' : '' }}>March</option>
  <option value="4" {{ $month == 4 ? 'selected' : '' }}>April</option>
  <option value="5" {{ $month == 5 ? 'selected' : '' }}>May</option>
  <option value="6" {{ $month == 6 ? 'selected' : '' }}>June</option>
  <option value="7" {{ $month == 7 ? 'selected' : '' }}>July</option>
  <option value="8" {{ $month == 8 ? 'selected' : '' }}>August</option>
  <option value="9" {{ $month == 9 ? 'selected' : '' }}>September</option>
  <option value="10" {{ $month == 10 ? 'selected' : '' }}>October</option>
  <option value="11" {{ $month == 11 ? 'selected' : '' }}>November</option>
  <option value="12" {{ $month == 12 ? 'selected' : '' }}>December</option>
</select>
     </div>
    </div>
    <div class="col-md-6">
     <div class="form-group">
      <select class="form-control form-control-limit form-control-sm bg-white" name="billing_exp_year">
        <option value="2024" {{ $year == 2024 ? 'selected' : '' }}>2024</option>
        <option value="2025" {{ $year == 2025 ? 'selected' : '' }}>2025</option>
        <option value="2026" {{ $year == 2026 ? 'selected' : '' }}>2026</option>
        <option value="2027" {{ $year == 2027 ? 'selected' : '' }}>2027</option>
        <option value="2028" {{ $year == 2028 ? 'selected' : '' }}>2028</option>
        <option value="2029" {{ $year == 2029 ? 'selected' : '' }}>2029</option>
        <option value="2030" {{ $year == 2030 ? 'selected' : '' }}>2030</option>
        <option value="2031" {{ $year == 2031 ? 'selected' : '' }}>2031</option>
        <option value="2032" {{ $year == 2032 ? 'selected' : '' }}>2032</option>
        <option value="2033" {{ $year == 2033 ? 'selected' : '' }}>2033</option>
        <option value="2034" {{ $year == 2034 ? 'selected' : '' }}>2034</option>
    </select>
    </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
      <x-text-input type="text" name="verification_num" placeholder="Verification Number" class="form-control" id="verification_num" />
    </div>
  </div>
 </div>

 <div class="row">
  <!-- same as above Checkbox -->
  <div class="col-md-6">
   Same as above <input type="checkbox" id="same_above"> 
  </div>
</div>


 <div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <textarea type="text" placeholder="Address" name="address" class="form-control" rows="6"
      id="address"></textarea>
 </div>
</div>

<div class="col-md-6">
 <div class="form-group">
  <x-text-input type="text" name="city" placeholder="City" class="form-control" id="city" />

  
</div>
</div>
</div>


<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <x-text-input type="text" name="state" placeholder="State" class="form-control" id="state" />

 </div>
</div>

<div class="col-md-6">
 <div class="form-group">
  <x-text-input type="text" name="zipcode" placeholder="Zipcode" class="form-control" id="zipcode" />


  
</div>
</div>
</div>

<div class="row">
  <div class="col-md-12">
      <div class="form-group">
          <select class="form-control bg-white" id="billcountry" name="countrybill" required>
              <option value="" disabled selected>Select Country</option>
              @foreach ($countries as $country)
                  <option value="{{ $country->name }}">{{ $country->name }}</option>
              @endforeach
          </select>
      </div>
  </div>
</div>


<!-- hidden ended -->
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

    <script>
      // Get elements
const toggleCheckbox = document.getElementById('toggleCheckbox');
const detailsDiv = document.getElementById('details');

// Function to show or hide the details div
toggleCheckbox.addEventListener('change', function() {
    if (toggleCheckbox.checked) {
        // Show the div
        detailsDiv.style.display = 'block';
    } else {
        // Hide the div
        detailsDiv.style.display = 'none';
    }
});

    </script>


<script>
  // Card type validation rules (using regular expressions)
  const cardRules = {
      'visa': /^4\d{12}(\d{3})?$/, // Visa: Starts with 4 and has 13 or 16 digits
      'mastercard': /^5[1-5]\d{14}$/, // MasterCard: Starts with 5 and has 16 digits
      'amex': /^3[47]\d{13}$/, // American Express: Starts with 34 or 37 and has 15 digits
      'discover': /^6(?:011|5\d{2})\d{12}$/, // Discover: Starts with 6 and has 16 digits
  };
  
  // Function to validate the credit card number
  function validateCardNumber() {
      const cardTypeElement = document.getElementById('card_type');
      const cardTypeText = cardTypeElement.options[cardTypeElement.selectedIndex].text;  // Get the selected card type name
      const cardNumber = document.getElementById('credit_number').value.trim();  // Get the card number input value
      const cardNumberInput = document.getElementById('credit_number');
      let isValid = false;
  
      // Ensure a valid card type is selected
      if (!cardTypeText || cardTypeText === 'Select Card Type') {
          cardNumberInput.classList.remove('is-invalid');
          cardNumberInput.classList.remove('is-valid');
          return;
      }
  
      // Validate the card number based on the selected card type
      switch (cardTypeText.toLowerCase()) {
          case 'visa':
              isValid = cardRules.visa.test(cardNumber);
              break;
          case 'mastercard':
              isValid = cardRules.mastercard.test(cardNumber);
              break;
          case 'american express':
              isValid = cardRules.amex.test(cardNumber);
              break;
          case 'discover':
              isValid = cardRules.discover.test(cardNumber);
              break;
          default:
              isValid = false;
              break;
      }
  
      // Show an alert based on the result of the validation
      if (isValid) {
          cardNumberInput.classList.add('is-valid');
          cardNumberInput.classList.remove('is-invalid');
      } else {
          cardNumberInput.classList.add('is-invalid');
          cardNumberInput.classList.remove('is-valid');
      }
  }
  
  // Function to format the credit card number as the user types
  function formatCardNumber() {
      const cardNumberInput = document.getElementById('credit_number');
      let formattedCardNumber = cardNumberInput.value.replace(/\D/g, ''); // Remove non-numeric characters
  
      // Add spaces between every 4 digits for readability
      formattedCardNumber = formattedCardNumber.replace(/(.{4})(?=.)/g, '$1 ');
  
      // Set the formatted value back to the input field
      cardNumberInput.value = formattedCardNumber;
  
      // Optional: You can call validation again after formatting (if you need)
      validateCardNumber();
  }


  
  
  </script>

  <script>
    //same as above code
  // Get elements
const sameAboveCheckbox = document.getElementById('same_above');
const billCountry = document.getElementById('billcountry');
const country = document.getElementById('country');

// Add event listener for checkbox state change
sameAboveCheckbox.addEventListener('change', function() {
    // If checkbox is checked, copy the selected country to billing country
    if (sameAboveCheckbox.checked) {
        billCountry.value = country.value;  // Set billing country to the selected country
    } else {
        billCountry.value = "";  // Reset billing country selection if checkbox is unchecked
    }
});

// Optional: Automatically update billing country when country is selected (if checkbox is checked)
country.addEventListener('change', function() {
    if (sameAboveCheckbox.checked) {
        billCountry.value = country.value;  // Sync with selected country
    }
});
  </script>
  
  <style>
  /* Styles to highlight invalid input */
  .is-invalid {
      border-color: red;
      box-shadow: 0 0 0 0.25rem rgba(255, 0, 0, 0.25);
  }
  
  .is-valid {
      border-color: green;
      box-shadow: 0 0 0 0.25rem rgba(0, 128, 0, 0.25);
  }
  </style>
  

</x-guest-layout>