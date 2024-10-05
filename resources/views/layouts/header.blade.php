
<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <!-- Spinner End -->
    <!-- preloader area end -->

   <!-- Content Start -->
   <div class="content">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-outer navbar-light sticky-top px-4 py-3">
        <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
          <img src="img/logo_resized.png" alt="" width="150px" />
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
          <i class="fa fa-bars h4 text-info"></i>
        </a>
      </nav>
      <!-- Navbar End -->

           
                             <!-- page title area end -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>