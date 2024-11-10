@extends('customer.base')
@section('action-content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Row 1 -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
                <img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/invoice.png')}}" alt="" >
                <p class="my-2 h6">Invoices</p>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
                <img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/contact-us.png')}}" alt="" >
                <p class="my-2 h6">Contact Us</p>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/customer/my-profile"><img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/profile.png')}}" alt="">
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
            <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/customer/orders/create"><img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/place_order.png')}}" alt="" >
              <p class="my-2 h6">Place Orders</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
        <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
        <a href="/customer/quotes/create"><img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/send-quote.png')}}" alt="">
              <p class="my-2 h6">Send Quote</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
        <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
        <a href="/customer/vector-orders/create"> <img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/add-vector.png')}}" alt="" >
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
            <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/customer/orders"> <img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/All_Orders.png')}}" alt="" >
              <p class="my-2 h6">Order Records</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
          <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
          <a href="/customer/quotes">  <img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/All_Quotes.png')}}" alt="" >
              <p class="my-2 h6">Quote Records</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
          <div class="card shadow-lg rounded d-flex flex-column align-items-center justify-content-center p-4">
          <a href="/customer/vector-orders">  <img class="icon-img-dashboard" src="{{asset('skypatch/img/icons/All_Vector.png')}}" alt="">
              <p class="my-2 h6">Vector Records</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <!-- Empty Column -->
        </div>
    </div>
</div>

@endsection
