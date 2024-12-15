@extends('digitizer.order-leader.base')
@section('action-content')



    <!-- All Content Goes inside this div -->
    <!-- All Content Goes inside this div -->
    <div class=" container-fluid py-4 px-4">
        <div class="row g-4 d-flex align-items-center justify-content-center">
            <div class="col-12">
                <div class="bg-table rounded h-100 p-4">
                    <div class="row mb-4">
                        <div class="col-6 d-flex justify-content-start align-items-center">
                            <h6 class="h6 mb-0">Orders Details</h6>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-end">
                            {{-- <button type="button"  
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button>  --}}

                         
                                <a href="{{ route('all-leader-orders.process', [$order->order_id]) }}"
                                    class="btn btn-sm btn-dark rounded-pill ">Process</a>
                          
                        </div>
                    </div>
                   
                    @include('digitizer.order-details.details')
                  
                </div>
  
                
                @include('digitizervectorterm/term')






            </div>
        </div>
        </div>
    </div>
    <!-- Content Div Ends here End -->



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
                    <form id="deleteFileAForm" method="POST" action="{{ route('allorders.deleteFileA') }}">
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
                        <form id="deleteFileBForm" method="POST" action="{{ route('allorders.deleteFileB') }}">
                            @csrf
                            <!-- Hidden input for file ID -->
                            <input type="text" hidden id="file_id_b" name="file_id" value="">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    
         
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



    <!-- Content Div Ends here End -->



@endsection
