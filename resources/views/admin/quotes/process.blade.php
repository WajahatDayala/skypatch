@extends('admin.quotes.base')
@section('action-content')

         <!-- All Content Goes inside this div -->
         <div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">Pricing Criteria</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Minimum Price</strong><br>
                                            <span id="miniPriceDisplay">{{ old('minimum_price', $pricing->minimum_price ?? '') }}</span>
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
                                    <tr class="row">
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
                                            <strong>Editing in stiches file</strong><br>
                                            <span id="editingStitchesFileDisplay">{{ old('editing_stitches_file', $pricing->editing_in_stitch_file ?? '') }}</span>
                                        </td>
                                    </tr>

                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Commment Box 1</strong><br>
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
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comment Box 4</strong><br>
                                            <span id="comment4Display">{{ old('comment_4', $pricing->comment_box_4 ?? '') }}</span> 
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">For Digitzer's/Vector Teams</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
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
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Thread</strong><br>
                                            <span> {{ old('thread', $vectordetails->thread ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Brand</strong><br>
                                            <span> {{ old('needle_brand', $vectordetails->needle_brand ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing(Pique / Jersey)</strong><br>
                                            <span> {{ old('backing_pique_jersey', $vectordetails->backing_pique_jersey ?? '') }}</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
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
                                    <tr class="row">
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
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comments</strong><br>
                                            <span> {{ old('comments', $vectordetails->comment_box ?? '') }}</span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>




                        </div>
                        <form action="{{route('allquotes.send')}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">Job Information</h1>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Number</strong><br>
                                                    <span>QT-{{$quote->quote_id}}</span>
                                                    <input type="text" hidden name="quote_id" value="{{$quote->quote_id}}">
                                                </td>
                                                <td class="col-3">
                                                    <strong>Date & Time</strong><br>
                                                    <span>{{$quote->received_date}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Customer Nick</strong><br>
                                                    <span>{{$quote->customer_name}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Desing Namw/PO</strong><br>
                                                    <span>{{$quote->design_name}}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Height</strong><br>
                                                    <span>{{$quote->height}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Width</strong><br>
                                                    <span>{{$quote->width}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Required Format</strong><br>
                                                    <span>{{$quote->format}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Placement</strong><br>
                                                    <span>{{$quote->placement}}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Number of Colors</strong><br>
                                                    <span>{{$quote->number_of_colors}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Fabric Type</strong><br>
                                                    <span>{{$quote->fabric_name}}</span>
                                                </td>
                                                <td class="col-6">
                                                    <strong>Design Type</strong><br>
                                                    <span></span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-12">
                                                    <strong>Customer Instructions</strong><br>
                                                    <span>{{ $quoteInstruction ? $quoteInstruction->instruction : 'No instruction available.' }}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-12">
                                                    <strong>Admin Instructions</strong><br>
                                                    <span>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }} </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-5">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                
                                            
                                                <td class="col-2">
                                                    
                                                </td>
                                                <td class="col-5 text-center">
                                                   <b>Option A</b>
                                                </td>
                                                <td class="col-5 text-center">
                                                    <b>Option B</b>
                                                </td>
                                            </tr>   
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Height
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="height_A" class="form-control" id="inputEmail3" value="{{ old('height_A', $jobInfo->height_A ?? '') }}"  step="any">
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="height_B" class="form-control" id="inputEmail3" value="{{$jobInfo->height_B ?? ''}}"  step="any">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Width
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="width_A" class="form-control" id="inputEmail3" value="{{ old('width_A', $jobInfo->width_A ?? '') }}"  step="any">
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="width_B" class="form-control" id="inputEmail3" value="{{ old('width_B', $jobInfo->width_B ?? '') }}"  step="any">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Stitches
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="stitches_A" class="form-control" id="inputEmail3" value="{{ old('stitches_A', $jobInfo->stitches_A ?? '')}}">
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="stitches_B" class="form-control" id="inputEmail3" value="{{ old('stitches_A',$jobInfo->stitches_B ?? '')}}">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Price
                                                </td>
                                                <td class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="number" id="price_A" name="price_A" class="form-control" placeholder="Price"
                                                            aria-label="Username" aria-describedby="basic-addon1" value="{{ old('price_A', $jobInfo->price_A ?? '')}}">
                                                    </div>
                                                </td>
                                                <td class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="number" id="price_B" name="price_B" class="form-control" placeholder="Price"
                                                            aria-label="Username" aria-describedby="basic-addon1" value="{{ old('price_B', $jobInfo->price_B ?? '')}}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Total
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" class="form-control" id="total" name="total" readonly  value="{{ old('total',$jobInfo->total ?? '')}}">
                                                </td>
                                                <td class="col-5">
                                                    {{-- <input type="number" class="form-control" id="total_B" readonly> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row">
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
                                                        <input type="checkbox" name="optionSendFilesA[]" value="{{ $filePath }}" checked>
                                                
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
                                                    <button type="button" class="btn btn-sm rounded-pill btn-primary m-2"
                                                    data-bs-toggle="modal" data-bs-target="#fileUploadModal1">Upload Files</button>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td>
                                                    <strong>Comment</strong><br>
                                                    <textarea class="form-control" name="comment" placeholder="Leave a comment here"
                                                        id="floatingTextarea" style="height: 150px;"></textarea>

                                                    <div class="mt-3">
                                                        <legend class="fs-6"><strong>Mail To:</strong></legend>
                                                        <br>
                                                        <div class="form-check">
                                                            @if($quote->email1)
                                                            <input class="form-check-input" checked type="checkbox" name="gridCheckemail1"
                                                            id="gridCheckemail1" value="{{$quote->email1}}">
                                                            <label class="form-check-label" for="gridCheckemai11">
                                                             
                                                               {{$quote->email1}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->email2)
                                                            <input class="form-check-input" checked type="checkbox" name="gridCheckemail2"
                                                            id="gridCheckemail2" value="{{$quote->email2}}">
                                                            <label class="form-check-label" for="gridCheckemail2">
                                                            {{$quote->email2}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->email4)
                                                            <input class="form-check-input" checked type="checkbox" name="gridCheckemail3"
                                                            id="gridCheckemail3" value="{{$quote->email3}}">
                                                            <label class="form-check-label" for="gridCheckemail3">
                                                            {{$quote->email3}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->email4)
                                                            <input class="form-check-input" checked type="checkbox" name="gridCheckemail4"
                                                                id="gridCheckemail4" value="{{$quote->email4}}">
                                                            <label class="form-check-label" for="gridCheckemail4">
                                                            {{$quote->email4}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->invoceEmail)
                                                            <input checked class="form-check-input" type="checkbox" id="gridCheckinvoiceemail" name="gridCheckinvoiceemail" value="{{$quote->invoceEmail}}">
                                                            <label for="gridCheckinvoiceemail">{{ $quote->invoceEmail }}</label>
                                                            @endif
                                                        </div>
                                                    </div>
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
                                                        <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked>
                                                
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
                            </div>

                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-2 d-flex">
                                    <button type="submit" class="btn btn-primary rounded-pill m-2">Send</button>
                                    <button type="button" class="btn btn-dark rounded-pill m-2">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
            <!-- Content Div Ends here End -->

            
            <!-- option A -->
             <!-- Modal for Multiple File Upload -->
             <div class="modal fade" id="fileUploadModal1" tabindex="-1" role="dialog"
             aria-labelledby="fileUploadModalLabel1" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="fileUploadModalLabel1">Upload Files</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                             aria-label="Close"></button>
                     </div>
                     <form id="fileUploadForm1" method="POST"
                         action="{{route('allquotes.optionA')}}"
                         enctype="multipart/form-data">
                         @csrf
                         <div class="modal-body">
                            
                             <div class="form-group">
                                 <label hidden for="order_id">Order ID</label>
                                 <input type="text" hidden class="form-control" 
                                     id="order_id" name="order_id" required
                                     value="{{ $quote->quote_id }}">
                             </div>
                             <div class="form-group">
                                 <label for="files">Choose Files</label>
                                 <input type="file" class="form-control" id="files"
                                     name="filesA[]" multiple required>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary"
                                 data-bs-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary">Upload</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>

         <!-- end file upload-->

         <!--option b -->
          <!-- Modal for Multiple File Upload -->
          <div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog"
          aria-labelledby="fileUploadModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="fileUploadModalLabel">Upload Files</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                          aria-label="Close"></button>
                  </div>
                  <form id="fileUploadForm" method="POST"
                      action="{{route('allquotes.optionB')}}"
                      enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                        
                          <div class="form-group">
                              <label hidden for="order_id">Order ID</label>
                              <input type="text" class="form-control" hidden
                                  id="order_id" name="order_id" required
                                  value="{{ $quote->quote_id }}">
                          </div>
                          <div class="form-group">
                              <label for="files">Choose Files</label>
                              <input type="file" class="form-control" id="files"
                                  name="filesB[]" multiple required>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary"
                              data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <!-- end file upload-->


      <!-- option A delete file -->

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


            <!-- Add this script to enable dynamic price updates -->
<script>
   // Get elements
const priceA = document.getElementById('price_A');
const priceB = document.getElementById('price_B');
const totalA = document.getElementById('total');
// const totalB = document.getElementById('total_B');  // Uncomment if you want another total B

// Function to update total
function updateTotal() {
    // Get values of priceA and priceB, and convert them to numbers
    const valueA = parseFloat(priceA.value) || 0;  // If input is empty or invalid, default to 0
    const valueB = parseFloat(priceB.value) || 0;  // If input is empty or invalid, default to 0

    // Set totalA to the sum of priceA and priceB
    totalA.value = valueA + valueB;
}

// Add event listeners to update totals when prices change
priceA.addEventListener('input', updateTotal);
priceB.addEventListener('input', updateTotal);
</script>



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
   
@endsection