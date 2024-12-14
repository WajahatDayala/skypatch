@extends('digitizer.quote-worker.quotes.base')
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
                            {{-- <button type="button"  
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button>  --}}
                            @if ($order->status_id == 2)
                                {{-- <a href="{{route('allquotes.edit',[$order->order_id])}}"
                        class="btn btn-sm btn-primary rounded-pill me-2">Edit</a>  --}}
                                <a href="{{ route('all-worker-quote.process', [$order->order_id]) }}"
                                    class="btn btn-sm btn-dark rounded-pill ">Process</a>
                            @endif
                        </div>
                    </div>
                
              
                      
         @include('digitizer/quote-details/details')

                   

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

    


    <!-- Content Div Ends here End -->



@endsection
