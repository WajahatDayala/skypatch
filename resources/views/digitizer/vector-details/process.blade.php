<div class="col-6 border-end">
    <div class="row bg-dark p-2">
        <h6 class="text-light fw-light text-center mb-0">Option A</h1>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr class="row">
                <td>
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
                        |
                        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileAModal">
                            Remove
                        </button>
                
                        <br>
                    @else
                        <p>No file available</p>
                    @endif
                @endforeach
                </td>
                <td>
                    <button type="button" class="btn btn-sm rounded-pill btn-primary m-2" data-bs-toggle="modal" data-bs-target="#fileUploadModalA">
                        Upload Files
                    </button>
             
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-6 border-start">
    <div class="row bg-dark p-2">
        <h6 class="text-light fw-light text-center mb-0">Option B</h1>
    </div>
    <table class="table table-bordered">
        <tbody>
            
            <tr class="row">
                <td>
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
      
              <!-- Checkbox for selection -->
              {{-- <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked> --}}
      
              <!-- Separator and remove button -->
              |
              <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order-b" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileBModal">
                  Remove
              </button>
      
              <br>
          @else
              <p>No file available</p>
          @endif
      @endforeach
                </td>
              
                
                <td>
                    <button type="button" class="btn btn-sm rounded-pill btn-primary m-2"
                    data-bs-toggle="modal" data-bs-target="#fileUploadModal">Upload Files</button>
                </td>
            </tr>
            <tr class="row">
                {{-- <td>
                    <strong>Comment</strong><br>
                    <textarea class="form-control" placeholder="Leave a comment here"
                        id="floatingTextarea" style="height: 150px;"></textarea>
                </td> --}}
            </tr>
        </tbody>
    </table>
</div>