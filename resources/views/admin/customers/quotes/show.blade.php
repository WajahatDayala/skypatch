@extends('admin.customers.quotes.base')
@section('action-content')


<!-- All Content Goes inside this div -->
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
                        <button type="button"  
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button> 
                        @if($order->edit_status == 1 && $order->status_id==1)
                        <a href="{{route('customer.edit-quote',[$order->order_id])}}"
                        class="btn btn-sm btn-primary rounded-pill me-2">Edit</a> 
                        @endif
                        @if($order->edit_status == 1 && $order->status_id == 2)
                        {{-- <a href="" class="btn btn-sm btn-dark rounded-pill ">Process</a> --}}
                        @endif
                    </div>
                </div>
                <table  class="table table-bordered">
                    <tbody>
                        <tr class="row">
                            <td class="col-3">
                                <strong>Quote Number</strong><br>
                                <span>OT-{{$order->order_id}}</span>
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
                                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}
                                <!-- Button trigger modal -->
@if($order->edit_status == 1)
<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#instructionModal">
 Update
</button>
@endif
</p>
<!-- Modal -->
<div class="modal fade" id="instructionModal" tabindex="-1" role="dialog" aria-labelledby="instructionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="instructionModalLabel">Customer Instruction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <form id="instructionForm" method="POST" action="{{ route('allquotes.addInstruction') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label hidden for="customer_id">Customer ID</label>
            <input type="text" class="form-control" hidden id="customer_id" name="customer_id" required value="{{$order->customer_id}}">
          </div>
          <div class="form-group">
            <label hidden for="order_id">Order ID</label>
            <input type="text" class="form-control" hidden id="order_id" name="order_id" required value="{{$order->order_id}}">
          </div>
          <div class="form-group">
            <label for="instruction">Instruction</label>
            <textarea class="form-control" id="instruction" name="instruction" rows="3" required>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</textarea>
          </div>
          <input type="hidden" name="emp_id" value="{{ auth()->user()->id }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

                            </td>
                            <td class="col-6">
                                <strong>Admin Instruction</strong><br>
                                
                                    <p>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }} 
                                    <!-- Button trigger modal -->
                                    @if($order->edit_status == 1)
<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#adminInstructionModal">
Update
</button>
@endif
</p>
<!-- Modal -->
<div class="modal fade" id="adminInstructionModal" tabindex="-1" role="dialog" aria-labelledby="adminInstructionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adminInstructionModalLabel">Add Admin Instruction</h5>
        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <form id="adminInstructionForm" method="POST" action="{{ route('allquotes.adminInstruction')}}">
        @csrf
        <div class="modal-body">
        <div class="form-group">
            <label hidden for="customer_id">Customer ID</label>
            <input type="text" class="form-control" hidden id="customer_id" name="customer_id" required value="{{$order->customer_id}}">
          </div>
          <div class="form-group">
            <label hidden for="order_id">Order ID</label>
            <input type="text" class="form-control" hidden id="order_id" name="order_id" required value="{{$order->order_id}}">
          </div>
          <div class="form-group">
            <label for="admin_instruction">Instruction</label>
            <textarea class="form-control" id="admin_instruction" name="admin_instruction" rows="3" required>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }} </textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


                            </td>
                        </tr>
                       <tr class="row">

                       @if($order->edit_status ==1) 
                       <td class="col-3">
                                            <h6>
                                                <!-- <strong><a href="" class="text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Not Assigned</a></strong><br>
                                                <strong class="text-info"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Assigned</a></strong><br> -->
                               
                                                      
                                @if(!$order->designer_id)
                               
                                 <strong>
                                <a href="#" class="text-danger" 
                                     data-bs-toggle="modal" 
                                     data-bs-target="#Designer" 
                                     data-id="{{ $order->order_id }}">Not Assigned</a>
                                </strong>
                                 @else
                                 <strong class="text-info" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#Designer" 
                                 data-id="{{ $order->order_id }}" 
                                 data-leader-id="{{ $order->designer_id }}">
                                {{ $order->designer_name }}
                                </strong>
                                @endif
                                            </h6>
                                            <!-- <p>John Doe</p> -->
                            </td>
                            @else
                            <td class="col-3">
                                            <h6>
                                                <!-- <strong><a href="" class="text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Not Assigned</a></strong><br>
                                                <strong class="text-info"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Assigned</a></strong><br> -->
                               
                                                      
                                @if(!$order->designer_id)
                               
                                <strong class="text-danger">
                                    Not Assign
                                </strong>
                                 @else
                                 <strong class="text-info">
                                {{ $order->designer_name }}
                                </strong>
                                @endif
                                            </h6>
                                            <!-- <p>John Doe</p> -->
                            </td>
                            
                            @endif



                                        @if($order->edit_status ==1)
                                        <td class="col-3">
                                            <h6>
                                                <strong>Quote Status</strong><br>
                                            </h6>
                                            <p class="mb-2">{{$order->order_status_name}} |
                                                
                                                <button type="button"
                                                    class="btn btn-sm rounded-pill btn-dark ms-2" data-file-id="" data-bs-toggle="modal" data-bs-target="#orderStatusModal">Update</button>
                                                    

                                                    <!-- Modal Order Status -->
<div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderStatusModalLabel">Update Order Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="orderStatusForm" method="POST" action="{{ route('allquotes.updateStatus')}}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label hidden for="customer_id">Customer ID</label>
            <input type="text" class="form-control" hidden id="customer_id" name="customer_id" required value="{{ $order->customer_id }}">
          </div>
          <div class="form-group">
            <label hidden for="order_id">Order ID</label>
            <input type="text" class="form-control" hidden id="order_id" name="order_id" required value="{{ $order->order_id }}">
          </div>
          <div class="form-group">
            <label for="order_status">Order Status</label>
            <select class="form-control" id="order_status" name="order_status" required>
            @foreach($orderStatus as $s)
            <option value="{{$s->id}}" {{ $s->id == $order->quotes_status ? 'selected' : '' }}>{{$s->name}}</option>
            @endforeach
              <!-- Add more statuses as needed -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- order status end-->
                                                </p>
                                         
                                        </td>
                                        @else
                                        <td class="col-3">
                                        <h6>
                                                <strong>Order Status</strong><br>
                                            </h6>
                                            <p class="mb-2">New |
                                                
                                               
                                                    
                                                </p>
                                            <p class="mb-0">Reason |
                                                
                                                  
                                                    Reason Not Specified
                                                    
                                               
                                            </p>

                                        </td>
                                        @endif
                                        <td class="col-6">
                                            <strong>Files</strong><br>
                                            @foreach($orderFiles as $f)
    @php
        $fileId = $f->fileId;
        $fileData = json_decode($f->files, true); // Decode the JSON
        $filePath = $fileData['path'] ?? 'No file'; // Get the file path
        $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
    @endphp
    <span class="text-info">{{ $originalFilename }} 
    @if($order->edit_status == 1) | 
        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileModal">Delete</button><br>
    @endif
    </span>
@endforeach

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFileModalLabel">Delete File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this file?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteFileForm" method="POST" action="{{ route('allquotes.deleteFile') }}">
                    @csrf
                    <input type="text" hidden id="file_id" name="file_id" value="">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                          
                                            <!-- <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                     class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span> -->
                                                    <!-- Button to Open the File Upload Modal -->
                                                    @if($order->edit_status == 1)
                                                    <button type="button" class="btn btn-sm rounded-pill btn-primary m-2" data-bs-toggle="modal" data-bs-target="#fileUploadModal">Attach Files</button>
                                                    @endif
<!-- Modal for Multiple File Upload -->
<div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileUploadModalLabel">Upload Files</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="fileUploadForm" method="POST" action="{{ route('allquotes.uploadFile')}}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label hidden for="customer_id">Customer ID</label>
            <input type="text" class="form-control" hidden id="customer_id" name="customer_id" required value="{{$order->customer_id}}">
          </div>
          <div class="form-group">
            <label hidden for="order_id">Order ID</label>
            <input type="text" class="form-control" hidden id="order_id" name="order_id" required value="{{$order->order_id}}">
          </div>
          <div class="form-group">
            <label for="files">Choose Files</label>
            <input type="file" class="form-control" id="files" name="files[]" multiple required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- end file upload-->
                                        </td>
                                    </tr>
                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Option A</strong><br>
                            </td>
                            <td class="col-6">
                                <strong>Option B</strong><br>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignLeaderForm" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" id="employee_id">
                    <div class="row mb-3">
                        <label for="designerSelect" class="col-sm-4 col-form-label text-end">Select Designer *</label>
                        <div class="col-sm-8">
                            <select name="designer_id" class="form-select" id="designerSelect" required>
                                <option selected class='text-gray' value="">Select Designer</option>
                                @foreach($designer as $l)
                                <option value="{{ $l->designer_id }}">{{ $l->designerName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
            </div>
        </div>
    </div>
</div>
                <!-- Modal for Edit Designer Ends Here -->

            </div>

            {{-- <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-info p-2">
                                <h6 class="text-secondary text-center mb-0">For Digitzer's/Vector Teams</h1>
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

                            <!-- Modal for Reason -->
                            <div class="modal fade" id="Reason" tabindex="-1" aria-labelledby="ReasonLabel"
                                aria-hidden="true">
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
                                                    <label for="reasonSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Reason *</label>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Reason Ends Here -->

                            <!-- Modal for Edit Designer Start Here -->
                            <div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel"
                                aria-hidden="true">
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
                                                    <label for="designerSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Designer
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Designer Ends Here -->

                        </div>

        </div> --}}
    </div>
</div>
<!-- Content Div Ends here End -->


<!-- JavaScript to handle the modal -->
<script>
    const deleteFileButtons = document.querySelectorAll('.delete-file-btn');
    const fileIdInput = document.getElementById('file_id');

    deleteFileButtons.forEach(button => {
        button.addEventListener('click', function() {
            const fileId = this.getAttribute('data-file-id');
            fileIdInput.value = fileId; // Set the file ID in the hidden input
        });
    });
</script>

<script>
    var designerModal = document.getElementById('Designer');
    designerModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var employeeId = button.getAttribute('data-id'); // Extract employee ID
        var leaderId = button.getAttribute('data-leader-id'); // Extract leader ID if assigned

        // Set the employee ID in the form
        document.getElementById('employee_id').value = employeeId;

        // Set the selected leader if already assigned
        var designerSelect = document.getElementById('designerSelect');
        designerSelect.value = leaderId || ''; // Set to selected leader or reset

        // Set the form action URL for updating the leader
        var form = document.getElementById('assignLeaderForm');
        form.action = '{{ url('admin/allquotes') }}/' + employeeId + '/allquote';
    });

    document.getElementById('saveChangesButton').addEventListener('click', function () {
        document.getElementById('assignLeaderForm').submit(); // Submit the form
    });
</script>


<!-- Content Div Ends here End -->





@endsection