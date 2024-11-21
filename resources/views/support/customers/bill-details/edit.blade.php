@extends('admin.customers.bill-details.base')
@section('action-content')

<!-- Blank Start -->
<div class="container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-center">Update Bill Information</h6>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('supportcustomer.updatedBill') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="row mb-3">
                        <label for="name" class="col-sm-4 col-form-label text-end">Cardholder's Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="card_holder_name" class="form-control" id="card_holder_name"
                                value="{{ $user->card_holder_name }}">
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="username" class="col-sm-4 col-form-label text-end">CardType</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="card_type" id="card_type" aria-label="Default select example" onchange="validateCardNumber()">
                                <option value="" selected class='text-gray'>Select Card Type</option>
                                @foreach($cardType as $t)
                                <option value="{{ $t->id }}" {{ $user->card_type_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>




                    <div class="row mb-3">
                        <label for="company_name" class="col-sm-4 col-form-label text-end">Credit Card Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="credit_number" id="credit_number" class="form-control" id="credit_number"
                                value="{{ $user->card_number }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="expiry" class="col-sm-4 col-form-label text-end">Credit Card Expiry</label>
                        @php
// Assuming the saved value is stored in a variable
$savedValue = $user->card_expiry; // Example saved value

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
                        
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                <select class="form-control form-control-limit form-control-sm" id="billing_exp_month" name="billing_exp_month">
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
                                <div class="col-md-3">
                                <select class="form-control form-control-limit form-control-sm" name="billing_exp_year">
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
                    </div>


                    <div class="row mb-3">
                        <label for="phone" class="col-sm-4 col-form-label text-end">Verification Number </label>
                        <div class="col-sm-8">
                            <input type="text" name="verification_num" class="form-control" id="verification_num"
                                value="{{ $user->vcc }}" >
                        </div>
                    </div>




                    <div class="row mb-3">
                        <label for="address" class="col-sm-4 col-form-label text-end">Address</label>
                        <div class="col-sm-8">
                            <textarea type="text" name="address" class="form-control" rows="6"
                                id="address">{{ $user->address }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="city" class="col-sm-4 col-form-label text-end">City</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" class="form-control" id="city" value="{{ $user->city }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="state" class="col-sm-4 col-form-label text-end">State</label>
                        <div class="col-sm-8">
                            <input type="text" name="state" class="form-control" id="state" value="{{ $user->state }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="zipcode" class="col-sm-4 col-form-label text-end">Zipcode</label>
                        <div class="col-sm-8">
                            <input type="text" name="zipcode" class="form-control" id="zipcode"
                                value="{{ $user->zipcode }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="country" class="col-sm-4 col-form-label text-end">Country</label>
                        <div class="col-sm-8">
                            <!-- <input type="text" name="country" class="form-control" id="country" value="{{ $user->country }}"> -->
                            <select class="form-select" name="country" aria-label="Default select example">
                                <option value="" selected class='text-gray'>Select Country</option>
                                @foreach($country as $f)
                                <option value="{{ $f->name }}" {{ $user->country == $f->name ? 'selected' : '' }}>
                                    {{ $f->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="customer_id" value="{{$user->id}}">

                    <div class="row mb-3">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    



</div>
<!-- Blank End -->


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
@endsection