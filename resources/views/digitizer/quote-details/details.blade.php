<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Quote Number</strong><br>
                <span>QT-{{ $order->order_id }}</span>
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
                <strong>Height</strong><br>
                <span>{{ $order->height }}"</span>
            </td>
            <td class="col-3">
                <strong>Width</strong><br>
                <span>{{ $order->width }}</span>
            </td>
            <td class="col-3">
                
            </td>
        </tr>
        <tr class="row">

            <td class="col-3">

                <strong>Format</strong><br>
                <span>{{ $order->format }}</span>

                
            </td>
            <td class="col-3">
                <strong>Fabric</strong><br>
                <span>{{ $order->fabric_name }}</span>
               
            </td>
            <td class="col-3">

                <strong>Number of Colors</strong><br>
                <span>{{ $order->number_of_colors }}</span>
                
            </td>
         
        </tr>


        <tr class="row">
             <td class="col-3">
                
                <strong>Placement</strong><br>
                <span>{{ $order->placement }}</span>
              
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
                {{ $jobInfo->stitches_B?? ''}}

            </p>
            </td>

            <td class="col-3">

           
            </td>
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
                            </a>
                        @else
                            <!-- For other files, provide download option -->
                            <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}" class="file-link">
                                 {{ $originalFilename }}
                            </a>
                        @endif
                
                        <!-- Checkbox for selection -->
                        {{-- <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked> --}}
                
                        <!-- Separator and remove button -->
                        {{-- |
                        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order-b" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileBModal">
                            Remove
                        </button> --}}
                
                        <br>
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
                        <strong>Quote Status</strong><br>
                    </h6>
                    <p class="mb-2">{{ $order->order_status_name }}
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
                
                        <!-- Checkbox for selection -->
                        {{-- <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked> --}}
                        |
                        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileAModal">
                            Remove
                        </button>

                            
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
                 
                
                        <br>
                    @else
                        <p>No file available</p>
                    @endif
                @endforeach     
                       
            </td>
            <td class="col-6">
                <strong>Option B</strong><br>
                @foreach ($optionB as $b)
                @php
                    $fileId = $b->fileId;
                    $fileData = json_decode($b->file_upload, true); // Decode the JSON
                    $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                    $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension
                    @endphp
                
                    @if ($filePath)
                        <!-- Check if the file is an image or PDF -->
                        @if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
                            <!-- If the file is an image or PDF, open in a new tab (preview) -->
                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
                                @if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg']))
                                    <!-- Preview image -->
                                    {{ $originalFilename }}
                                    {{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
                                @else
                                    <!-- Display PDF link -->
                                    {{ $originalFilename }}
                                @endif
                            </a>
                        @else
                            <!-- For other files, provide download option -->
                            <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}" class="file-link">
                                 {{ $originalFilename }}
                            </a>
                        @endif
                
                        <!-- Checkbox for selection -->
                        {{-- <input type="checkbox" name="optionSendFilesA[]" value="{{ $filePath }}" checked> --}}
                
                        <!-- Separator and remove button -->

                               <!-- Separator and remove button -->
                               |
                               <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order-b" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileBModal">
                                   Remove
                               </button>


                

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
                
                        <br>
                    @else
                        <p>No file available</p>
                    @endif
                @endforeach
            </td>
        </tr>
    </tbody>
</table>


<!--option A -->
<script>
    // JavaScript to handle the modal for Option A
   const deleteFileButtonsOptionA = document.querySelectorAll('.delete-file-btn-order');  // Correct class name for Option A
   const fileIdInputOptionA = document.getElementById('file_id_a');  // Hidden input for Option A
   
   deleteFileButtonsOptionA.forEach(button => {
       button.addEventListener('click', function() {
           const fileId = this.getAttribute('data-file-id');
           console.log('File ID:', fileId);  // Debugging log to see if fileId is passed correctly
           fileIdInputOptionA.value = fileId; // Set the file ID in the hidden input for Option A modal
       });
   });
   
   </script>
   <!-- option A -->
   
   <!-- option B -->
   <script>
       // JavaScript to handle the modal for Option A
      const deleteFileButtonsOptionB = document.querySelectorAll('.delete-file-btn-order-b');  // Correct class name for Option A
      const fileIdInputOptionB = document.getElementById('file_id_b');  // Hidden input for Option A
      
      deleteFileButtonsOptionB.forEach(button => {
          button.addEventListener('click', function() {
              const fileId = this.getAttribute('data-file-id');
              console.log('File ID:', fileId);  // Debugging log to see if fileId is passed correctly
              fileIdInputOptionB.value = fileId; // Set the file ID in the hidden input for Option A modal
          });
      });
      
      </script>
   <!-- option B -->