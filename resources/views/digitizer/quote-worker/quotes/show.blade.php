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
                          
                                {{-- <a href="{{route('allquotes.edit',[$order->order_id])}}"
                        class="btn btn-sm btn-primary rounded-pill me-2">Edit</a>  --}}
                                <a href="{{ route('all-worker-quote.process', [$order->order_id]) }}"
                                    class="btn btn-sm btn-dark rounded-pill ">Process</a>
                          
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


    


    <!-- Content Div Ends here End -->



@endsection
