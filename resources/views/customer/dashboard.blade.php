<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
  <meta charset="utf-8">
  <title>SkyPatch-CRM</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Favicon -->
  <link href="{{asset('skypatch/img/favicon.ico')}}" rel="icon" />

  <script src="https://kit.fontawesome.com/6126233f1a.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="{{asset('skypatch/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />
  <link href="{{asset('skypatch/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet" /> -->

  <link rel="stylesheet" href="{{asset('skypatch/css/bootstrap.css')}}">
  <!-- Template Stylesheet -->
  <link href="{{asset('skypatch/css/style.css')}}" rel="stylesheet" />
</head>
<body>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
  <!-- Main Header -->
  @include('layouts.header')
    <!-- Sidebar -->
  @include('layouts.sidebar')
  @yield('content')
    <!-- /.content-wrapper -->
    <!-- Footer -->
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
              <img src="{{asset('skypatch/img/icons/employee.png')}}" alt="" width="50px">
              <p class="my-2 h6">Employees</p>
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
              <img src="{{asset('skypatch/img/icons/All_Customer.png')}}" alt="" width="50px">
              <p class="my-2 h6">All Customers</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/sales-team-report.png')}}" alt="" width="50px">
              <p class="my-2 h6">Sales Team Report</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/Annum_Report.png')}}" alt="" width="50px">
              <p class="my-2 h6">Record Annum</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/Sales_Annum_Report.png')}}" alt="" width="50px">
              <p class="my-2 h6">Sales Annum</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/Desinger_Report.png')}}" alt="" width="50px">
              <p class="my-2 h6">Designers Report</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/Accounts.png')}}" alt="" width="50px">
              <p class="my-2 h6">Accounts</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/sales_commission.png')}}" alt="" width="50px">
              <p class="my-2 h6">Sales Commission</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/designer_leader.png')}}" alt="" width="50px">
              <p class="my-2 h6">Desingers & Leaders</p>
            </div>
          </div>

          <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="bg-box rounded d-flex flex-column align-items-center justify-content-center p-4">
              <img src="{{asset('skypatch/img/icons/edit_report.png')}}" alt="" width="50px">
              <p class="my-2 h6">Edit Reports</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Dashboard Cards End -->


  @include('layouts.footer')
    <!-- ./wrapper -->




     <!-- new script for admintheme-->
   
<script src="{{ asset('admintheme/assets/js/scripts.js')}}"></script>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
 <script src="{{ asset('skypatch/lib/chart/chart.min.js')}}"></script>
 <script src="{{ asset('skypatch/lib/easing/easing.min.js')}}"></script>
 <script src="{{ asset('skypatch/lib/waypoints/waypoints.min.js')}}"></script>
 <script src="{{ asset('skypatch/lib/owlcarousel/owl.carousel.min.js')}}"></script>
 <script src="{{ asset('skypatch/lib/tempusdominus/js/moment.min.js')}}"></script>
 <script src="{{ asset('skypatch/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
 <script src="{{ asset('skypatch/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

 <!-- Template Javascript -->
 <script src="{{ asset('skypatch/js/main.js')}}"></script>

<script type="text/javascript">
    


$(document).ready( function () {
   $('#dataTable').DataTable();
} );


</script>


<!-- new scripted for admintheme -->

</body>

</html>
