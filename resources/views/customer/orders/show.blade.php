@extends('customer.orders.base')
@section('action-content')

<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="bg-table rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Order Details</h6>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <!-- <button type="button"
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button> -->
                        @if($order->edit_status == 1 && $order->status_id == 1)
                        
                        <a type="button" href="{{ route('orders.edit', ['order' => $order->order_id]) }}"
                                        class="btn btn-sm btn-dark rounded-pill ">Edit</a>
                        @endif
                    </div>
                </div>
                {{-- <table class="table table-bordered">
                    <tbody>
                        <tr class="row">
                            <td class="col-3">
                                <strong>Order Number</strong><br>
                                <span>OR-{{$order->order_id}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Status</strong><br>
                                @if($order->status_id ==2)
                                <span>{{$order->status}}</span>
                                @elseif($order->status_id ==1)
                                <span>{{$order->status}}</span>

                                @endif

                            </td>
                            <td class="col-3">
                                <strong>Release Date</strong><br>
                                <span>@if(!$order->date_finalized)
                                    N/A
                                    @endif
                                    {{$order->date_finalized}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Received Date</strong><br>
                                <span>{{$order->received_date}}</span>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-3">
                                <strong>Design Name/PO</strong><br>
                                <span>{{$order->design_name}} {{$order->description}}
                                </span>
                            </td>
                            <td class="col-3">
                                <strong>Height</strong><br>
                                <span>{{$order->height}}"</span>
                            </td>
                            <td class="col-3">
                                <strong>Width</strong><br>
                                <span>{{$order->width}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Format</strong><br>
                                <span>{{$order->format}}</span>
                            </td>
                        </tr>
                        <tr class="row">

                            <td class="col-3">
                                <strong>Fabric</strong><br>
                                <span>{{$order->fabric_name}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Number of Colors</strong><br>
                                <span>{{$order->number_of_colors}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Placement</strong><br>
                                <span>{{$order->placement}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Customer Nick</strong><br>
                                <span>{{$order->customer_name}}</span>
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
                                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</p>
                            </td>
                            <td class="col-6">
                                <strong>Admin Instruction</strong><br>
                                <p>
                                    {{$order->instruction}}

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
                </table> --}}

                @include('customer.order-details.details')

          


            </div>


        </div>
    </div>
</div>
<!-- Content Div Ends here End -->



@endsection