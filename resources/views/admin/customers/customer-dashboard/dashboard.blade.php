@extends('admin.customers.customer-dashboard.base')
@section('action-content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Row 1 -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
                <img src="{{asset('skypatch/img/icons/invoice.png')}}" alt="" width="50px">
                <p class="my-2 h6">Invoices</p>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
                <img src="{{asset('skypatch/img/icons/contact-us.png')}}" alt="" width="50px">
                <p class="my-2 h6">Contact Us</p>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/customer/my-profile"><img src="{{asset('skypatch/img/icons/profile.png')}}" alt="" width="50px">
                <p class="my-2 h6">Profile</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <!-- Empty Column -->
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Row 2 -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/customer/orders/create"><img src="{{asset('skypatch/img/icons/place_order.png')}}" alt="" width="50px">
              <p class="my-2 h6">Place Orders</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
        <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
        <a href="/customer/quotes/create"><img src="{{asset('skypatch/img/icons/send-quote.png')}}" alt="" width="50px">
              <p class="my-2 h6">Send Quote</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
        <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
        <a href="/customer/vector-orders/create"> <img src="{{asset('skypatch/img/icons/add-vector.png')}}" alt="" width="50px">
              <p class="my-2 h6">Vectors Order</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <!-- Empty Column -->
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Row 3 -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/customer/orders"> <img src="{{asset('skypatch/img/icons/All_Orders.png')}}" alt="" width="50px">
              <p class="my-2 h6">Order Records</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
          <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
          <a href="/customer/quotes">  <img src="{{asset('skypatch/img/icons/All_Quotes.png')}}" alt="" width="50px">
              <p class="my-2 h6">Quote Records</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
          <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
          <a href="/customer/vector-orders">  <img src="{{asset('skypatch/img/icons/All_Vector.png')}}" alt="" width="50px">
              <p class="my-2 h6">Vector Records</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <!-- Empty Column -->
        </div>
    </div>
</div>

@endsection
