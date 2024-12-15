<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Vector Number</strong><br>
                <span>VO-{{ $order->order_id }}</span>
            </td>
            <td class="col-3">
                <strong>Status</strong><br>
                @if ($order->status_id == 2)
                    <span>{{ $order->status }}</span>
                @elseif($order->status_id == 1)
                    <span>{{ $order->status }}</span>
                @endif

            </td>
            <td class="col-3">
                <strong>Release Date</strong><br>
                <span>
                    @if (!$order->date_finalized)
                        N/A
                    @endif
                    {{ $order->date_finalized }}
                </span>
            </td>
            <td class="col-3">
                <strong>Received Date</strong><br>
                <span>{{ $order->received_date }}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-3">
                <strong>Design Name/PO</strong><br>
                <span>{{ $order->design_name }} {{ $order->description }}
                </span>
            </td>
           
            <td class="col-3">
                <strong>Format</strong><br>
                <span>{{ $order->format }}</span>
            </td>

            
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{ $order->number_of_colors }}</span>
            </td>
        </tr>
        <tr class="row">

          
           
            {{-- <td class="col-3">
            <strong>Customer Nick</strong><br>
            <span>{{$order->customer_name}}</span>
        </td> --}}
        </tr>


        <tr class="row">
            {{-- <td class="col-6">
            <strong class="">Price</strong><br>
            <p></p>
                <!-- <button type="button"
                                class="btn btn-sm rounded-pill btn-primary m-2">Update</button> -->

        </td> --}}
            
        </tr>

        <tr class="row">
            <td class="col-6">
                <strong>Files</strong><br>
                @foreach ($orderFiles as $f)
                    @php
                        $fileId = $f->fileId;
                        $fileData = json_decode($f->files, true); // Decode the JSON
                        $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                        $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension

@endphp
@if ($filePath)
<!-- Check if the file is an image or PDF -->
@if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
    <!-- If the file is an image or PDF, open in a new tab (preview) -->
    <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
        {{ $originalFilename }}
        {{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
    </a><br>
@else
    <!-- For other files, provide download option -->
    <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}" class="file-link">
         {{ $originalFilename }}
    </a><br>
@endif

<!-- Checkbox for selection -->
{{-- <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked> --}}
@else
<p>No file available</p>
@endif
@endforeach
            </td>
            <td class="col-6">

                
                <strong class="">Customer Instruction</strong><br>
                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}
                   
                </p>



            </td>
        </tr>
        <tr class="row">

          
                <td class="col-3">
                    <h6>
                     

                        @if (!$order->designer_id)
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
        


               <td class="col-3">
                    <h6>
                        <strong>Vector Status</strong><br>
                    </h6>
                    <p class="mb-2">{{ $order->order_status_name }}

                    
                    <!-- order status end-->
                    </p>

                </td>
           
            <td class="col-6">
                <strong>Admin Instruction</strong><br>

                <p>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }}
                   
                </p>


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
                    $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension

@endphp
@if ($filePath)
<!-- Check if the file is an image or PDF -->
@if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
<!-- If the file is an image or PDF, open in a new tab (preview) -->
<a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
{{ $originalFilename }}
{{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
</a>
@else
<!-- For other files, provide download option -->
<a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}" class="file-link">
{{ $originalFilename }}
</a>
@endif
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
<form id="deleteFileAForm" method="POST" action="{{ route('allvectors.deleteFileA') }}">
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
                    $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension

@endphp

@if ($filePath)
<!-- Check if the file is an image or PDF -->
@if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
   <!-- If the file is an image or PDF, open in a new tab (preview) -->
   <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
       {{ $originalFilename }}
       {{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
   </a>
@else
   <!-- For other files, provide download option -->
   <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}" class="file-link">
        {{ $originalFilename }}
   </a>
@endif
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
        <form id="deleteFileBForm" method="POST" action="{{ route('allvectors.deleteFileB') }}">
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