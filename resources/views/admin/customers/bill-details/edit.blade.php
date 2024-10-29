@extends('admin.customers.bill-details.base')
@section('action-content')

<!-- Blank Start -->
<div class="container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-center">Update Personal Information</h6>

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

                <form action="{{ route('customers.updateBillInfo', ['id',$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                  

                  
                    <div class="row mb-3">
                        <label for="name" class="col-sm-4 col-form-label text-end">Cardholder's Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="card_holder_name" class="form-control" id="card_holder_name"
                                value="{{ $user->card_holder_name }}" required>
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="username" class="col-sm-4 col-form-label text-end">CardType</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="card_type" aria-label="Default select example">
                                <option value="" selected class='text-gray'>Select Card Type</option>
                                @foreach($cardType as $t)
                                <option value="{{ $t->name }}" {{ $user->card_type_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>




                    <div class="row mb-3">
                        <label for="company_name" class="col-sm-4 col-form-label text-end">Credit Card Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="credit_number" class="form-control" id="credit_number"
                                value="{{ $user->card_number }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="expiry" class="col-sm-4 col-form-label text-end">Credit Card Expiry</label>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control form-control-limit form-control-sm" required=""
                                        id="billing_exp_month" name="billing_exp_month">
                                        <option selected="selected" value="">Select Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-control-limit form-control-sm" required
                                        name="billing_exp_year">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="phone" class="col-sm-4 col-form-label text-end">Verification Number </label>
                        <div class="col-sm-8">
                            <input type="text" name="verification_num" class="form-control" id="verification_num"
                                value="{{ $user->vcc }}" required>
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

@endsection