@extends('customer.base')
@section('action-content')
  <!-- Dashboard Cards Start -->
  <div class=" container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/Todays_Order.png')}}" alt="" width="50px">
              <p class="my-2 h6">Today's Orders</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <!-- <i class="fa-solid fa-envelope fa-3x text-primary"></i> -->
              <img src="{{asset('skypatch/img/icons/Todays_Quote.png')}}" alt="" width="50px">
              <p class="my-2 h6">Today's Quotes</p>
            </div>
          </div>

          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/Todays_vector.png')}}" alt="" width="50px">
              <p class="my-2 h6">Today's Vectors</p>
            </div>
          </div>
           <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/All_Orders.png')}}" alt="" width="50px">
              <p class="my-2 h6">All Orders</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/All_Quotes.png')}}" alt="" width="50px">
              <p class="my-2 h6">All Quotes</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/All_Vector.png')}}" alt="" width="50px">
              <p class="my-2 h6">All Vectors</p>
            </div>
          </div>

         <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/invoice.png')}}" alt="" width="50px">
              <p class="my-2 h6">Invoices</p>
            </div>
          </div>
        
        
         <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/invoice.png')}}" alt="" width="50px">
              <p class="my-2 h6">Contact Us</p>
            </div>
          </div>
          
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/invoice.png')}}" alt="" width="50px">
              <p class="my-2 h6">Profile</p>
            </div>
          </div>
         
         
          

          
        </div>
      </div>
      <!-- Dashboard Cards End -->

@endsection