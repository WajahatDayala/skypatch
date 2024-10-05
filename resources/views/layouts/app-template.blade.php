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
    <div class="main-content">
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


