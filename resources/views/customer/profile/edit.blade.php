@extends('customer.profile.base')
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

                <form action="{{ route('my-profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->


                    <div class="row mb-3">
                        <label for="userId" class="col-sm-4 col-form-label text-end">ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="userId" class="form-control @error('userId') is-invalid @enderror" id="id" value="{{ $user->id }}" readonly>
                            @error('userId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-4 col-form-label text-end">Name*</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-4 col-form-label text-end">Email*</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-4 col-form-label text-end">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control @error('userId') is-invalid @enderror" id="username" value="{{ $user->username }}" readonly>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="showing_password" class="col-sm-4 col-form-label text-end">Current Password</label>
                        <div class="col-sm-8">
                            <input type="text" readonly  name="showing_password" class="form-control @error('showing_password') is-invalid @enderror" id="showing_password" value="{{$user->showing_password}}">
                            @error('showing_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="new_password" class="col-sm-4 col-form-label text-end">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="new_password" placeholder="Leave blank to keep current password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="contact_name" class="col-sm-4 col-form-label text-end">Contact Name*</label>
                        <div class="col-sm-8">
                            <input type="text" name="contact_name" class="form-control" id="contact_name" value="{{ $user->contact_name }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="company_name" class="col-sm-4 col-form-label text-end">Company Name*</label>
                        <div class="col-sm-8">
                            <input type="text" name="company_name" class="form-control" id="company_name" value="{{ $user->company_name }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="company_type" class="col-sm-4 col-form-label text-end">Company Type*</label>
                        <div class="col-sm-8">
                            <!-- <input type="text" name="company_type" class="form-control" id="company_type" value="{{ $user->company_type }}" required> -->
                                         <select class="form-select" name="company_type" aria-label="Default select example">
                                            <option value="" selected class='text-gray'>Company Type</option>
                                          
                                            <option value="Embroider" 
                                            {{ $user->company_type == 'Embroider' ? 'selected' : '' }}>
                                                Embroider
                                            </option>
                                           
                                            <option value="Distributor" 
                                            {{ $user->company_type == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                                            <option value="Promotional" 
                                            {{ $user->company_type == 'Promotional' ? 'selected' : '' }}>Promotional</option>
                                            <option value="Marketing" 
                                            {{ $user->company_type == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                            <option value="Manufacturers" 
                                            {{ $user->company_type == 'Manufacturers' ? 'selected' : '' }}>Manufacturers</option>
                                            <option value="Uniform/Apparels" 
                                            {{ $user->company_type == 'Uniform/Apparels' ? 'selected' : '' }}>Uniform/Apparels</option>
                                            <option value="Others" 
                                            {{ $user->company_type == 'Others' ? 'selected' : '' }}>Others</option>

                                           
                                            </select>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-sm-4 col-form-label text-end">Phone*</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cell" class="col-sm-4 col-form-label text-end">Cell</label>
                        <div class="col-sm-8">
                            <input type="text" name="cell" class="form-control" id="cell" value="{{ $user->cell }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fax" class="col-sm-4 col-form-label text-end">Fax</label>
                        <div class="col-sm-8">
                            <input type="text" name="fax" class="form-control" id="fax" value="{{ $user->fax }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email_1" class="col-sm-4 col-form-label text-end">Email 1*</label>
                        <div class="col-sm-8">
                            <input type="email" name="email_1" class="form-control" id="email_1" value="{{ $user->email_1 }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email_2" class="col-sm-4 col-form-label text-end">Email 2</label>
                        <div class="col-sm-8">
                            <input type="email" name="email_2" class="form-control" id="email_2" value="{{ $user->email_2 }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email_3" class="col-sm-4 col-form-label text-end">Email 3</label>
                        <div class="col-sm-8">
                            <input type="email" name="email_3" class="form-control" id="email_3" value="{{ $user->email_3 }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email_4" class="col-sm-4 col-form-label text-end">Email 4</label>
                        <div class="col-sm-8">
                            <input type="email" name="email_4" class="form-control" id="email_4" value="{{ $user->email_4 }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="invoice_email" class="col-sm-4 col-form-label text-end">Invoice Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="invoice_email" class="form-control" id="invoice_email" value="{{ $user->invoice_email }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-sm-4 col-form-label text-end">Address</label>
                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}">
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
                            <input type="text" name="zipcode" class="form-control" id="zipcode" value="{{ $user->zipcode }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="country" class="col-sm-4 col-form-label text-end">Country</label>
                        <div class="col-sm-8">
                            <!-- <input type="text" name="country" class="form-control" id="country" value="{{ $user->country }}"> -->
                            <select class="form-select" name="country" aria-label="Default select example">
                                            <option value="" selected class='text-gray'>Select Country</option>
                                            @foreach($country as $f)
                                            <option value="{{ $f->name }}" 
                                            {{ $user->country == $f->name ? 'selected' : '' }}>
                                             {{ $f->name }}
                                            </option>
                                            @endforeach
                                            </select>
                        </div>
                    </div>

                    

                    <div class="row mb-3">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

@endsection
