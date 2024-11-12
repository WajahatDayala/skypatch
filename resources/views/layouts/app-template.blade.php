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

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css.map">


   

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/5.0.3/css/fixedColumns.dataTables.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="main-content">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
  <!-- Main Header -->
    @include('layouts.header')
    <!-- Sidebar -->
    @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Admin')
    @include('layouts.admin.sidebar')

     <!--quote digitizer -->
    @elseif(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Quote Digitizer Worker'
    || Auth::user()->role->name === 'Quote Digitizer Leader'
    )
    @include('layouts.digitizer.quote-digitizers.worker.sidebar')
    <!-- end quote digitizer -->

    <!--order digitizer -->
    @elseif(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Order Digitizer Worker'
    || Auth::user()->role->name === 'Order Digitizer Leader'
    )
    @include('layouts.digitizer.order-digitizer.sidebar')
    <!-- end order digitizer -->


    @elseif(Auth::check() && Auth::user()->username)
    @include('layouts.sidebar')
    @endif
    
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
  <script  type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Template Javascript -->
  <script src="{{ asset('skypatch/js/main.js')}}"></script>
 
  <script>
    
$(document).ready( function () {
    $('#dataTable').DataTable();
} );

</script>

<!-- new scripted for admintheme -->

  
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.3/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

</body>

</html>


