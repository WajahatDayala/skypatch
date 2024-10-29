@extends('admin.customers.profile-details.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0"></h6>
                </div>
                <div class="row">
                    <!--profile info-->
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-fixed text-start align-middle table-bordered mb-0">

                                <tbody>
                                    <tr class="table-info">
                                        <td colspan="2" class="text-center">Personal Information
                                            <a href="{{ route('customers.edit', ['customer' => $user->id]) }}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td><b class="fw-bold">ID</b><br>
                                            {{$user->id}}
                                        </td>
                                        <td><b class="fw-bold">Name</b><br>
                                            {{$user->name}}
                                        </td>
                                    </tr>
                                    
                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Company Name
                                            </b><br>
                                            {{$user->company_name}}
                                        </td>
                                        <td><b class="fw-bold">Company Type
                                            </b><br>
                                            {{$user->company_type}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Phone
                                            </b><br>
                                            {{$user->phone}}
                                        </td>
                                        <td><b class="fw-bold">Cell
                                            </b><br>
                                            {{$user->cell}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td colspan="2"><b class="fw-bold">Fax
                                            </b><br>
                                            {{$user->fax}}
                                        </td>
                                    </tr>


                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Email Address#1
                                            </b><br>
                                            {{$user->email}}
                                        </td>
                                        <td><b class="fw-bold">Email Address#2
                                            </b><br>
                                            {{$user->email_2}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Email Address#3
                                            </b><br>
                                            {{$user->email_3}}
                                        </td>
                                        <td><b class="fw-bold">Email Address#4
                                            </b><br>
                                            {{$user->email_4}}
                                        </td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td colspan="2"><b class="fw-bold">Invoice Email
                                            </b><br>
                                            {{$user->invoice_email}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Address
                                            </b><br>
                                            {{$user->address}}
                                        </td>
                                        <td><b class="fw-bold">City
                                            </b><br>
                                            {{$user->city}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">State
                                            </b><br>
                                            {{$user->state}}
                                        </td>
                                        <td><b class="fw-bold">Zipcode
                                            </b><br>
                                            {{$user->zipcode}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Country
                                            </b><br>
                                            {{$user->country}}
                                        </td>
                                        <td><b class="fw-bold">Registration Date
                                            </b><br>
                                            {{$user->created_at}}
                                        </td>
                                    </tr>


                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Username
                                            </b><br>
                                           {{$user->username}}
                                        </td>
                                        <td><b class="fw-bold">Password
                                            </b><br>
                                            {{$user->showing_password}}
                                        </td>
                                    </tr>







                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--profile info-->


                    <!--bill info-->
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-fixed text-start align-middle table-bordered mb-0">

                                <tbody>
                                    <tr class="table-info">
                                        <td colspan="2" class="text-center">Bill Information
                                            <a href="{{route('customers.billInfo',[$user->id])}}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Card Holder's Name
                                        </b><br>
                                            
                                        </td>
                                        <td><b class="fw-bold">Card Type
                                        </b><br>
                                            Select Card Type
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Card Number
                                            </b><br>
                                            
                                        </td>
                                        <td><b class="fw-bold">Card Expiry
                                            </b><br>
                                            /
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">VCC
                                            </b><br>
                                            
                                        </td>
                                        <td><b class="fw-bold">Address
                                            </b><br>
                                            
                                        </td>
                                    </tr>



                        

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">City
                                            </b><br>

                                        </td>
                                        <td><b class="fw-bold">State
                                            </b><br>

                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Zipcode
                                            </b><br>

                                        </td>
                                        <td><b class="fw-bold">Country
                                            </b><br>

                                        </td>
                                    </tr>

                          

                               





                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--bill info-->

                </div>




            </div>
        </div>
        <!-- Recent Sales End -->
    </div>






<!--priceing -->
    <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-info p-2">
                                <h6 class="text-light fw-light text-center mb-0">For Digitzer's/Vector Teams</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong># of Machine(s)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Condition</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Needles</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Thread</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Brand</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing(Pique / Jersey)</strong><br>
                                            <span>lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Brand</strong><br>
                                            <span>psd</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cotton / Twill)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cap)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Backing</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Number</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Heads</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comments</strong><br>
                                            <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni
                                                possimus perspiciatis ad dicta, incidunt accusamus. Voluptatibus, veniam
                                                laboriosam! Vitae, iure.</span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
</div>



</div>
<!-- Blank End -->


@endsection