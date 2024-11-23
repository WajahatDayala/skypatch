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
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" id="updateBtn">Update</a>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Minimum Price</strong><br>
                        <span id="miniPriceDisplay">{{ old('mini_price', $pricing->minimum_price ?? '') }}</span>
                        <input type="number" name="mini_price" id="miniPriceInput" class="form-control" value="{{ old('mini_price', $pricing->minimum_price ?? '') }}" style="display: none;">
                        <input type="text" hidden name="customer_id" value="{{$user->id}}">
                    </td>
                    <td class="col-4">
                        <strong>Maximum Price</strong><br>
                        <span id="maxPriceDisplay">{{ old('max_price', $pricing->maximum_price ?? '') }}</span>
                        <input type="number" name="max_price" id="maxPriceInput" class="form-control" value="{{ old('max_price', $pricing->maximum_price ?? '') }}" style="display: none;">
                    </td>
                    <td class="col-4">
                        <strong>1000 Stitches</strong><br>
                        <span id="stitchesDisplay">{{ old('stitches', $pricing->stitches ?? '') }}</span>
                        <input type="number" name="stitches" id="stitchesInput" class="form-control" value="{{ old('stitches', $pricing->stitches ?? '') }}" style="display: none;">
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Normal Delivery</strong><br>
                        <span id="deliveryTypeDisplay">
                            {{ old('delivery_type', optional($pricing)->delivery_type_id == 1 ? 'Normal Delivery' : (optional($pricing)->delivery_type_id == 2 ? 'Super Urgent' : '')) }}
                        </span>
                        <select class="form-control" name="delivery_type_id" id="deliveryTypeInput" style="display: none;">
                            <option value="1" {{ old('delivery_type', optional($pricing)->delivery_type_id) == 1 ? 'selected' : '' }}>Normal Delivery</option>
                            <option value="2" {{ old('delivery_type', optional($pricing)->delivery_type_id) == 2 ? 'selected' : '' }}>Super Urgent</option>
                        </select>
                    </td>
                    
                    <td class="col-4">
                        <strong>Editing/Changes</strong><br>
                        <span id="editingChangesDisplay">{{ old('editing_changes', $pricing->editing_changes ?? '') }}</span>
                        <input type="text" name="editing_changes" id="editingChangesInput" class="form-control" value="{{ old('editing_changes', $pricing->editing_changes ?? '') }}" style="display: none;">
                    </td>
                    <td class="col-4">
                        <strong>Editing in stitches file</strong><br>
                        <span id="editingStitchesFileDisplay">{{ old('editing_stitches_file', $pricing->editing_in_stitch_file ?? '') }}</span>
                        <input type="text" name="editing_stitches_file" id="editingStitchesFileInput" class="form-control" value="{{ old('editing_stitches_file', $pricing->editing_in_stitch_file ?? '') }}" style="display: none;">
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Comment Box 1</strong><br>
                        <span id="comment1Display">{{ old('comment_1', $pricing->comment_box_1 ?? '') }}</span>
                        <textarea class="form-control" name="comment_1" id="comment1Input" style="display: none;">{{ old('comment_1', $pricing->comment_box_1 ?? '') }}</textarea>
                    </td>
                    <td class="col-4">
                        <strong>Comment Box 2</strong><br>
                        <span id="comment2Display">{{ old('comment_2', $pricing->comment_box_2 ?? '') }}</span>
                        <textarea class="form-control" name="comment_2" id="comment2Input" style="display: none;">{{ old('comment_2', $pricing->comment_box_2 ?? '') }}</textarea>
                    </td>
                    <td class="col-4">
                        <strong>Comment Box 3</strong><br>
                        <span id="comment3Display">{{ old('comment_3', $pricing->comment_box_3 ?? '') }}</span>
                        <textarea class="form-control" name="comment_3" id="comment3Input" style="display: none;">{{ old('comment_3', $pricing->comment_box_3 ?? '') }}</textarea>
                    </td>
                </tr>
                <tr class="bg-white">
                    <td class="col-4">
                        <strong>Comment Box 4</strong><br>
                        <span id="comment4Display">{{ old('comment_4', $pricing->comment_box_4 ?? '') }}</span>
                        <textarea class="form-control" name="comment_4" id="comment4Input" style="display: none;">{{ old('comment_4', $pricing->comment_box_4 ?? '') }}</textarea>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success mx-2" id="saveBtn" style="display: none;">Save</button>
                            <button type="button" class="btn btn-secondary mx-2" id="closeBtn" style="display: none;">Close</button>
                        </div>
                    </td>
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

<!--fileds for pricing -->
<script>
  // Toggle between view and edit mode
function toggleEditMode(isEditMode) {
    const elementsToToggle = [
        { display: 'miniPrice', input: 'miniPriceInput' },
        { display: 'maxPrice', input: 'maxPriceInput' },
        { display: 'stitches', input: 'stitchesInput' },
        { display: 'deliveryType', input: 'deliveryTypeInput' },
        { display: 'editingChanges', input: 'editingChangesInput' },
        { display: 'editingStitchesFile', input: 'editingStitchesFileInput' },
        { display: 'comment1', input: 'comment1Input' },
        { display: 'comment2', input: 'comment2Input' },
        { display: 'comment3', input: 'comment3Input' },
        { display: 'comment4', input: 'comment4Input' }
    ];

    elementsToToggle.forEach(({ display, input }) => {
        document.getElementById(`${display}Display`).style.display = isEditMode ? "none" : "block";
        document.getElementById(input).style.display = isEditMode ? "block" : "none";
    });

    document.getElementById("saveBtn").style.display = isEditMode ? "block" : "none";
    document.getElementById("closeBtn").style.display = isEditMode ? "block" : "none";
}

document.getElementById("updateBtn").addEventListener("click", () => {
    toggleEditMode(true);
});

document.getElementById("closeBtn").addEventListener("click", () => {
    toggleEditMode(false);
});

document.getElementById("saveBtn").addEventListener("click", () => {
    document.getElementById("pricingForm").submit();
});

    </script>


@endsection