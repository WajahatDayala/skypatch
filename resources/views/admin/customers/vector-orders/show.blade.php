@extends('admin.customers.vector-orders.base')
@section('action-content')

<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="bg-table rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Vector Details</h6>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <!-- <button type="button"
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button> -->
                        @if($order->edit_status ==1)
                        <a type="button" href="{{ route('customer.edit-vector-order', ['id' => $order->order_id]) }}"
                                        class="btn btn-sm btn-dark rounded-pill ">Edit</a>
                        @endif
                    </div>
                </div>
              
  <!--order details page-->
  @include('vector-order-details/vector_order_details')
               


            </div>


        </div>
    </div>
</div>
<!-- Content Div Ends here End -->



@endsection