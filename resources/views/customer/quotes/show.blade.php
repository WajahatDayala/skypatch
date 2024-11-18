@extends('customer.quotes.base')
@section('action-content')

<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="bg-table rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Quote Details</h6>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <!-- <button type="button"
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button> -->
                        @if($quote->edit_status == 1 && $quote->status_id==1)
                        <a type="button" href="{{ route('quotes.edit', ['quote' => $quote->order_id]) }}"
                            class="btn btn-sm btn-dark rounded-pill ">Edit</a>
                        @endif
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr class="row">
                            <td class="col-3">
                                <strong>Quote Number</strong><br>
                                <span>QT-{{$quote->order_id}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Status</strong><br>
                                @if($quote->status_id ==2)
                                <span>{{$quote->status}}</span>
                                @elseif($quote->status_id ==1)
                                <span>{{$quote->status}}</span>

                                @endif

                            </td>
                            <td class="col-3">
                                <strong>Release Date</strong><br>
                                <span>@if(!$quote->date_finalized)
                                    N/A
                                    @endif
                                    {{$quote->date_finalized}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Received Date</strong><br>
                                <span>{{$quote->received_date}}</span>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-3">
                                <strong>Design Name/PO</strong><br>
                                <span>{{$quote->design_name}} {{$quote->description}}
                                 
                                </span>
                            </td>
                            <td class="col-3">
                                <strong>Height</strong><br>
                                <span>{{$quote->height}}"</span>
                            </td>
                            <td class="col-3">
                                <strong>Width</strong><br>
                                <span>{{$quote->width}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Format</strong><br>
                                <span>{{$quote->format}}</span>
                            </td>
                        </tr>
                        <tr class="row">

                            <td class="col-3">
                                <strong>Fabric</strong><br>
                                <span>{{$quote->fabric_name}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Number of Colors</strong><br>
                                <span>{{$quote->number_of_colors}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Placement</strong><br>
                                <span>{{$quote->placement}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Customer Nick</strong><br>
                                <span>{{$quote->customer_name}}</span>
                            </td>
                        </tr>


                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Price</strong><br>
                                <p></p>
                                    <!-- <button type="button"
                                                    class="btn btn-sm rounded-pill btn-primary m-2">Update</button> -->

                            </td>
                            <td class="col-6">
                                <strong>Stitching </strong><br>
                                <p>
                                   

                                </p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Customer Instruction</strong><br>
                                <p>{{ $quoteInstruction ? $quoteInstruction->instruction : 'No instruction available.' }}</p>
                                    <!-- <button type="button"
                                                    class="btn btn-sm rounded-pill btn-primary m-2">Update</button> -->

                            </td>
                            <td class="col-6">
                                <strong>Admin Instruction</strong><br>
                                <p>
                                    {{$quote->instruction}}

                                </p>
                            </td>
                        </tr>
                        <!-- <tr class="row">
                                        <td class="col-3">
                                            <h6>
                                                <strong><a href="" class="text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Not Assigned</a></strong><br>
                                                <strong class="text-info"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Assigned</a></strong><br>
                                            </h6>
                                            <p>John Doe</p>
                                        </td>
                                        <td class="col-3">
                                            <h6>
                                                <strong>Order Status</strong><br>
                                            </h6>
                                            <p class="mb-2">New |
                                                <button type="button"
                                                    class="btn btn-sm rounded-pill btn-dark ms-2">Update</button>
                                            </p>
                                            <p class="mb-0">Reason |
                                                <button type="button" class="btn btn-sm rounded-pill btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#Reason">
                                                    Reason Not Specified
                                                </button>
                                            </p>
                                        </td>
                                        <td class="col-6">
                                            <strong>Files</strong><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <button type="button" class="btn btn-sm rounded-pill btn-primary m-2">Attech
                                                Files</button>
                                        </td>
                                    </tr> -->
                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Option A</strong><br>
                                @foreach ($optionA as $a)
                                @php
                                    $fileId = $a->fileId;
                                    $fileData = json_decode($a->file_upload, true); // Decode the JSON
                                    $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                                    $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                                @endphp
                               
                                {{ $originalFilename }}
                                @endforeach
                            </td>
                            <td class="col-6">
                                <strong>Option B</strong><br>
                                @foreach ($optionB as $b)
                                @php
                                    $fileId = $b->fileId;
                                    $fileData = json_decode($b->file_upload, true); // Decode the JSON
                                    $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                                    $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                                @endphp
                               
                                {{ $originalFilename }}
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Modal for Reason -->
                <div class="modal fade" id="Reason" tabindex="-1" aria-labelledby="ReasonLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ReasonLabel">Reasons</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="row mb-3">
                                        <label for="reasonSelect" class="col-sm-4 col-form-label text-end">Select Reason
                                            *</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="reasonSelect"
                                                aria-label="Default select example">
                                                <option selected class='text-gray'>Select Format</option>
                                                <option value="1">Sales</option>
                                                <option value="2">Support</option>
                                                <option value="3">Accounts</option>
                                                <option value="4">Digitizer Leader</option>
                                                <option value="5">Digitizer</option>
                                                <option value="6">Vector Artist Leader</option>
                                                <option value="7">Vector Artist</option>
                                                <option value="8">Quote Digitizer Leader</option>
                                                <option value="9">Quote Digitizer</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for Edit Reason Ends Here -->

                <!-- Modal for Edit Designer Start Here -->
                <div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DesignerLabel">Designer Assignment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="row mb-3">
                                        <label for="designerSelect" class="col-sm-4 col-form-label text-end">Select
                                            Designer
                                            *</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="designerSelect"
                                                aria-label="Default select example">
                                                <option selected class='text-gray'>Select Designer</option>
                                                <option value="1">Designer 1</option>
                                                <option value="2">Designer 2</option>
                                                <option value="3">Designer 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for Edit Designer Ends Here -->

            </div>


        </div>
    </div>
</div>
<!-- Content Div Ends here End -->



@endsection