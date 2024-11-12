@extends('digitizer.order-leader.base')
@section('action-content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Row 1 -->
      
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/order-leader/today-leader-order"><img class="icon-img-dashboard" src="http://127.0.0.1:8000/skypatch/img/admin/today_order.png" alt="">
                    <p class="my-2 h6">Today's Order</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/order-leader/all-leader-orders"><img class="icon-img-dashboard" src="http://127.0.0.1:8000/skypatch/img/admin/all_orders.png" alt="">
                    <p class="my-2 h6">All Orders</p></a>
            </div>
        </div>

        

        <div class="col-sm-6 col-md-3 col-xl-3">
            <!-- Empty Column -->
             
        </div>
    </div>

   
    <div class="row g-4 mt-3">
        <!-- Row 3 -->
       


        <div class="col-sm-6 col-md-3 col-xl-3">
            <!-- Empty Column -->
        </div>
    </div>
</div>

@endsection
