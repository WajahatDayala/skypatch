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
    <form action="{{ route('pricing.save') }}" method="POST" id="pricingForm">
        @csrf

        <table class="table table-fixed text-start align-middle table-bordered mb-0">
            <tbody>
                <tr class="table-info">
                    <td colspan="3" class="text-center">
                        Pricing Details
                        <a href="{{route('pricing.support-pricing-details',['id'=>$user->id])}}" class="btn btn-sm btn-primary" id="updateBtn">Update</a>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Minimum Price</strong><br>
                        <span id="miniPriceDisplay">{{ old('mini_price', $pricing->minimum_price ?? '') }}</span>
                    </td>
                    <td class="col-4">
                        <strong>Maximum Price</strong><br>
                        <span id="maxPriceDisplay">{{ old('max_price', $pricing->maximum_price ?? '') }}</span>
                    </td>
                    <td class="col-4">
                        <strong>1000 Stitches</strong><br>
                        <span id="stitchesDisplay">{{ old('stitches', $pricing->stitches ?? '') }}</span>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Normal Delivery</strong><br>
                        <span id="deliveryTypeDisplay">
                            {{ old('delivery_type', optional($pricing)->delivery_type_id == 1 ? 'Normal Delivery' : (optional($pricing)->delivery_type_id == 2 ? 'Super Urgent' : '')) }}
                        </span>
                          
                    </td>
                    
                    <td class="col-4">
                        <strong>Editing/Changes</strong><br>
                        <span id="editingChangesDisplay">{{ old('editing_changes', $pricing->editing_changes ?? '') }}</span>
                    </td>
                    <td class="col-4">
                        <strong>Editing in stitches file</strong><br>
                        <span id="editingStitchesFileDisplay">{{ old('editing_stitches_file', $pricing->editing_in_stitch_file ?? '') }}</span>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Comment Box 1</strong><br>
                        <span id="comment1Display">{{ old('comment_1', $pricing->comment_box_1 ?? '') }}</span>
                    </td>
                    <td class="col-4">
                        <strong>Comment Box 2</strong><br>
                        <span id="comment2Display">{{ old('comment_2', $pricing->comment_box_2 ?? '') }}</span>
                    </td>
                    <td class="col-4">
                        <strong>Comment Box 3</strong><br>
                        <span id="comment3Display">{{ old('comment_3', $pricing->comment_box_3 ?? '') }}</span>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Comment Box 4</strong><br>
                        <span id="comment4Display">{{ old('comment_4', $pricing->comment_box_4 ?? '') }}</span> 
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>





<!-- For Digitizer's/Vector Teams -->
<div class="row bg-light rounded align-items-center justify-content-center mx-0 p-4 mt-4">
   
    <table class="table table-fixed text-start align-middle table-bordered mb-0">
        <tbody>
            <tr class="table-info">
                <td colspan="3" class="text-center">Vector Details
                <a href="{{route('vectordetails.support-vector-details',['id'=>$user->id])}}" class="btn btn-sm btn-primary">Update</a>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong># of Machine(s)</strong><br>
                    <span> {{ old('machine', $vectordetails->machine ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Condition</strong><br>
                    <span> {{ old('condition', $vectordetails->condition ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong># of Needles</strong><br>
                    <span> {{ old('needles', $vectordetails->needles ?? '') }}</span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong>Thread</strong><br>
                    <span> {{ old('thread', $vectordetails->thread ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Needle Brand</strong><br>
                    <span> {{ old('needle_brand', $vectordetails->needle_brand ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Backing (Pique / Jersey)</strong><br>
                    <span> {{ old('backing_pique_jersey', $vectordetails->backing_pique_jersey ?? '') }}</span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong>Brand</strong><br>
                    <span> {{ old('brand', $vectordetails->brand ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Backing (Cotton / Twill)</strong><br>
                    <span> {{ old('backing_cotton_twill', $vectordetails->backing_cotton_twill ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Backing (Cap)</strong><br>
                    <span> {{ old('backing_cap', $vectordetails->backing_cap ?? '') }}</span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4">
                    <strong>Model</strong><br>
                    <span> {{ old('model', $vectordetails->model ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Needle Number</strong><br>
                    <span> {{ old('needle_number', $vectordetails->needle_number ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong># of Heads</strong><br>
                    <span> {{ old('heads', $vectordetails->head ?? '') }}</span>
                </td>
            </tr>
            <tr class="bg-white">
                <td class="col-4" colspan="3">
                    <strong>Comments</strong><br>
                    <span> {{ old('comments', $vectordetails->comment_box ?? '') }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>





</div>
<!-- Blank End -->

@endsection