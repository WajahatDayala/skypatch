@extends('digitizer.vector-worker.order.base')
@section('action-content')

         <!-- All Content Goes inside this div -->
         <div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-12">
                 

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

                        <!--jobinfo-->
                        @include('digitizer.vector-details.jobinfo')

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row">
                         @include('digitizer.vector-details.process')
                            
                            </div>

                            {{-- <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-2 d-flex">
                                    <button type="button" class="btn btn-primary rounded-pill m-2">Send</button>
                                    <button type="button" class="btn btn-dark rounded-pill m-2">Reset</button>
                                </div>
                            </div> --}}
                        </div>


                    </div>
                </div>
            </div>
            <!-- Content Div Ends here End -->
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