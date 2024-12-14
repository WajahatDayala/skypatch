@extends('digitizer.order-worker.order.base')
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
                           
                                {{-- <a href="{{route('allquotes.edit',[$order->order_id])}}"
                        class="btn btn-sm btn-primary rounded-pill me-2">Edit</a>  --}}
                                <a href="{{ route('all-worker-orders.process', [$order->order_id]) }}"
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
        designerModal.addEventListener('show.bs.modal', function(event) {
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

        document.getElementById('saveChangesButton').addEventListener('click', function() {
            document.getElementById('assignLeaderForm').submit(); // Submit the form
        });
    </script>


    <!-- Content Div Ends here End -->



@endsection
