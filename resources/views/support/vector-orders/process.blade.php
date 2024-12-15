@extends('support.vector-orders.base')
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
                        <form id="mainForm" action="{{route('support-vector-orders.send')}}" method="POST">
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
                                                    <span>VO-{{$order->order_id}}</span>
                                                    <input type="text" hidden name="order_id" value="{{$order->order_id}}">
                                                </td>
                                                <td class="col-3">
                                                    <strong>Date & Time</strong><br>
                                                    <span>{{$order->received_date}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Customer Nick</strong><br>
                                                    <span>{{$order->customer_name}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Desing Namw/PO</strong><br>
                                                    <span>{{$order->design_name}}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Height</strong><br>
                                                    <span>{{$order->height}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Width</strong><br>
                                                    <span>{{$order->width}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Required Format</strong><br>
                                                    <span>{{$order->format}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Placement</strong><br>
                                                    <span>{{$order->placement}}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Number of Colors</strong><br>
                                                    <span>{{$order->number_of_colors}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Fabric Type</strong><br>
                                                    <span>{{$order->fabric_name}}</span>
                                                </td>
                                                <td class="col-6">
                                                    <strong>Design Type</strong><br>
                                                    <span></span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-12">
                                                    <strong>Customer Instructions</strong><br>
                                                    <span>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</span>
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
                                       
                                            {{-- <tr class="row d-flex align-items-center justify-content-center">
                                                
                                            
                                                <td class="col-2">
                                                    Height
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="height_A" class="form-control" id="inputEmail3" value="{{ old('height_A', $jobInfo->height_A ?? '') }}"  step="any">
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="height_B" class="form-control" id="inputEmail3" value="{{$jobInfo->height_B ?? ''}}"  step="any">
                                                </td>
                                            </tr> --}}
                                            {{-- <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Width
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="width_A" class="form-control" id="inputEmail3" value="{{ old('width_A', $jobInfo->width_A ?? '') }}"  step="any">
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="width_B" class="form-control" id="inputEmail3" value="{{ old('width_B', $jobInfo->width_B ?? '') }}"  step="any">
                                                </td>
                                            </tr> --}}
                                            {{-- <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Stitches
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="stitches_A" class="form-control" id="inputEmail3" value="{{ old('stitches_A', $jobInfo->stitches_A ?? '')}}">
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" name="stitches_B" class="form-control" id="inputEmail3" value="{{ old('stitches_A',$jobInfo->stitches_B ?? '')}}">
                                                </td>
                                            </tr> --}}
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
                                @include('vector-order-details.process')
                            </div>

                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-2 d-flex">
                                    <button type="submit" class="btn btn-primary rounded-pill m-2">Send</button>
                                    <button type="reset" class="btn btn-dark rounded-pill m-2">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>

 <!-- file optionA -->
            
 <!-- Modal for Option A -->
 <div class="modal fade" id="fileUploadModalA" tabindex="-1" aria-labelledby="fileUploadModalLabelA" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileUploadModalLabelA">Upload Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="fileUploadFormA" action="{{ route('allvectors.optionA') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label hidden for="order_id">Order ID</label>
                        <input type="text" hidden class="form-control" id="order_id" name="order_id" required value="{{ $order->order_id }}">
                    </div>
                    <input type="file" class="form-control" id="filesA" name="filesA[]" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUploadA" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--option B -->
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
                   action="{{route('allvectors.optionB')}}"
                   enctype="multipart/form-data">
                   @csrf
                   <div class="modal-body">
                     
                       <div class="form-group">
                           <label hidden for="order_id">Order ID</label>
                           <input type="text" class="form-control" hidden
                               id="order_id" name="order_id" required
                               value="{{ $order->order_id }}">
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

          <!-- Delete Confirmation Modal for Option b -->
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