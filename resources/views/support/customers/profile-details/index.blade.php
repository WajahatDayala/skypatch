@extends('admin.customers.profile-details.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="tbg-ligh text-center rounded p-4">
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
                                            <a href="{{ route('supportcustomers.edit', ['supportcustomer' => $user->id]) }}" class="btn btn-sm btn-primary">Update</a>
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
                                            <a href="{{route('supportcustomers.billInfo',[$user->id])}}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Card Holder's Name
                                        </b><br>
                                            {{$billInfo?$billInfo->card_holder_name : ''}}
                                        </td>
                                        <td><b class="fw-bold">Card Type
                                        </b><br>
                                        {{$billInfo?$billInfo->cardType:''}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Card Number
                                            </b><br>
                                            {{$billInfo?$billInfo->card_number:''}}
                                        </td>
                                        <td><b class="fw-bold">Card Expiry
                                            </b><br>
                                            {{$billInfo?$billInfo->card_expiry:''}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">VCC
                                            </b><br>
                                           
                                            {{$billInfo?$billInfo->vcc:''}}
                                        </td>
                                        <td><b class="fw-bold">Address
                                            </b><br>
                                            {{$billInfo?$billInfo->address:''}}
                                        </td>
                                    </tr>



                        

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">City
                                            </b><br>
                                            {{$billInfo?$billInfo->city:''}}
                                        </td>
                                        <td><b class="fw-bold">State
                                            </b><br>
                                            {{$billInfo?$billInfo->state:''}}
                                        </td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td><b class="fw-bold">Zipcode
                                            </b><br>
                                            {{$billInfo?$billInfo->zipcode:''}}
                                        </td>
                                        <td><b class="fw-bold">Country
                                            </b><br>
                                            {{$billInfo?$billInfo->country:''}}
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

<!-- Pricing Criteria -->

<div class="row bg-light rounded align-items-center justify-content-center mx-0 p-4 mt-4">
       
        <table class="table table-fixed text-start align-middle table-bordered mb-0">
            <tbody>
                <tr class="table-info">
                    <td colspan="3" class="text-center">Pricing Details
                    <a href="" class="btn btn-sm btn-primary">Update</a>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Minimum Price</strong><br>
                        <span></span>
                    </td>
                    <td class="col-4">
                        <strong>Maximum Price</strong><br>
                        <span></span>
                    </td>
                    <td class="col-4">
                        <strong>1000 Stitches</strong><br>
                        <span></span>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Normal Delivery</strong><br>
                        <span></span>
                    </td>
                    <td class="col-4">
                        <strong>Editing/Changes</strong><br>
                        <span></span>
                    </td>
                    <td class="col-4">
                        <strong>Editing in stitches file</strong><br>
                        <span></span>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Comment Box 1</strong><br>
                        <span></span>
                    </td>
                    <td class="col-4">
                        <strong>Comment Box 2</strong><br>
                        <span></span>
                    </td>
                    <td class="col-4">
                        <strong>Comment Box 3</strong><br>
                        <span></span>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4" colspan="3">
                        <strong>Comment Box 4</strong><br>
                        <span></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


<!-- For Digitizer's/Vector Teams -->
<div class="row bg-light rounded align-items-center justify-content-center mx-0 p-4 mt-4">
   
    <table class="table table-fixed text-start align-middle table-bordered mb-0">
        <tbody>
            <tr class="table-info">
                <td colspan="3" class="text-center">Vector Details
                <a href="" class="btn btn-sm btn-primary">Update</a>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong># of Machine(s)</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong>Condition</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong># of Needles</strong><br>
                    <span></span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong>Thread</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong>Needle Brand</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong>Backing (Pique / Jersey)</strong><br>
                    <span></span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong>Brand</strong><br>
                    <span>psd</span>
                </td>
                <td class="col-4">
                    <strong>Backing (Cotton / Twill)</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong>Backing (Cap)</strong><br>
                    <span></span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong>Backing</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong>Needle Number</strong><br>
                    <span></span>
                </td>
                <td class="col-4">
                    <strong># of Heads</strong><br>
                    <span></span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4" colspan="3">
                    <strong>Comments</strong><br>
                    <span></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>





</div>
<!-- Blank End -->


@endsection