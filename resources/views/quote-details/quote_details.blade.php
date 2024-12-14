<table  class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Quote Number</strong><br>
                <span>QT-{{$order->order_id}}</span>
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
                <strong class="">Price</strong><br>
                <p>{{ $jobInfo->total ?? ''}}</p>
            </td>
        </tr>
        <tr class="row">
          
            <td class="col-3">
                <strong>Format</strong><br>
            <span>{{$order->format}}</span>
            </td>
            <td class="col-3">
                <strong>Fabric</strong><br>
                <span>{{$order->fabric_name}}</span>
               
            </td>
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{$order->number_of_colors}}</span>
                
            </td>
            <td class="col-3">
              
            </td>
        </tr>

        
        <tr class="row">
            <td class="col-3">
                <strong>Placement</strong><br>
                <span>{{$order->placement}}</span>
                   

            </td>
            <td class="col-3">
                <strong>Stitches A</strong><br>
                <p>
                    {{ $jobInfo->stitches_A ?? ''}}

                </p>
            </td>
            <td class="col-3">
                <strong>Stitches B</strong><br>
                <p>
                    {{ $jobInfo->stitches_B ?? ''}}

                </p>
            </td>
            <td class="col-3">
                <strong>Customer Nick</strong><br>
                <span>{{$order->customer_name}}</span>
            </td>
          
        </tr>

        
        <tr class="row">
            <td class="col-6">
                <strong>Files</strong><br>
                @foreach($orderFiles as $f)
@php
$fileId = $f->fileId;
$fileData = json_decode($f->files, true); // Decode the JSON
$filePath = $fileData['path'] ?? 'No file'; // Get the file path
$originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
@endphp
<span class="text-info"> 
@if ($filePath)
<!-- Create a clickable link to download the file dynamically -->
<a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}">
{{ $originalFilename }}
</a>
@else
<p>No file available</p>
@endif

 | 
<button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileModal">Delete</button><br>

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
              
                         <button type="button" class="btn btn-sm rounded-pill btn-primary m-2" data-bs-toggle="modal" data-bs-target="#fileUploadModal">Attach Files</button>
                     
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
            <td class="col-6">
                <strong class="">Customer Instruction</strong><br>
                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}
                <!-- Button trigger modal -->

<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#instructionModal">
Update
</button>

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
        </tr>
       <tr class="row">

   
       <td class="col-3">
                            <h6>
                              
                                      
                @if(!$order->designer_id)
               
                 <strong>
                <a href="#" class="text-danger" 
                     data-bs-toggle="modal" 
                     data-bs-target="#Designer" 
                     data-id="{{ $order->order_id }}">Not Assigned</a>
                </strong>
                 @else
                 <a class="text-info" 
                 data-bs-toggle="modal" 
                 data-bs-target="#Designer" 
                 data-id="{{ $order->order_id }}" 
                 data-leader-id="{{ $order->designer_id }}">
                {{ $order->designer_name }}
                </a>
                @endif
                            </h6>
                            <!-- <p>John Doe</p> -->
            </td>
            
        

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
<h5 class="modal-title" id="orderStatusModalLabel">Update Quote Status</h5>
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
<label for="order_status">Quote Status</label>
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
                     
                        <td class="col-6">
                            <strong>Admin Instruction</strong><br>
                
                            <p>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }} 
                            <!-- Button trigger modal -->
                       
<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#adminInstructionModal">
Update
</button>

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
            <td class="col-6">
                <strong class="">Option A</strong><br>
                @foreach ($optionA as $a)
                @php
                    $fileId = $a->fileId;
                    $fileData = json_decode($a->file_upload, true); // Decode the JSON
                    $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                    $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                @endphp
               
               @if ($filePath)
                  <!-- Create a clickable link to download the file dynamically -->
                <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}">
                 {{ $originalFilename }}
                 </a>
                | 
                 <!-- Add a unique class for order files -->
                 <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileAModal">Remove</button><br>
                  
                @else
                <p>No file available</p>
                @endif
                
                @endforeach
               
           <!-- Delete Confirmation Modal for Option A -->
<div class="modal fade" id="deleteFileAModal" tabindex="-1" role="dialog" aria-labelledby="deleteFileAModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="deleteFileAModalLabel">Delete File for Option A</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<p>Are you sure you want to delete this file?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<form id="deleteFileAForm" method="POST" action="{{ route('allquotes.deleteFileA') }}">
    @csrf
    <!-- Hidden input for file ID -->
    <input type="text" hidden id="file_id_a" name="file_id" value="">
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</div>
</div>
</div>
</div>
       
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
               
               @if ($filePath)
               <!-- Create a clickable link to download the file dynamically -->
             <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}">
             {{ $originalFilename }}
              </a>
              | 
              <!-- Add a unique class for order files -->
              <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order-b" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileBModal">Remove</button><br>
              
             @else
             <p>No file available</p>
             @endif
                @endforeach





           <!-- Delete Confirmation Modal for Option A -->
           <div class="modal fade" id="deleteFileBModal" tabindex="-1" role="dialog" aria-labelledby="deleteFileBModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteFileBModalLabel">Delete File for Option B</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this file?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteFileBForm" method="POST" action="{{ route('allquotes.deleteFileB') }}">
                            @csrf
                            <!-- Hidden input for file ID -->
                            <input type="text" hidden id="file_id_b" name="file_id" value="">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </td>
        </tr>
    </tbody>
</table>



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