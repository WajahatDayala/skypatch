   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-outer navbar-light d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <a href="index.html" class="d-flex align-items-center justify-content-center">
            <img src="  {{asset('skypatch/img/logo_resized.png')}}" alt="skypatch_logo" />
          </a>
          
          <div class="my-3 d-flex flex-column align-items-center justify-content-center">
            <h6 class="mb-0 h4 customer-name">{{Auth()->user()->name}}</h6>
            <span class="h6  text-light fw-light">{{Auth()->user()->role->name}}</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a href="{{url('/admin/dashboard')}}" class="nav-item nav-link  {{ request()->is('admin/dashboard') ? 'active' : '' }}" ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          <!-- <a href="{{url('/admin/today-quotes')}}" class="nav-item nav-link {{ request()->is('admin/today-quotes') ? 'active' : '' }}"><i class="fa-solid fa-quote-right me-2"></i>
            Today's Quotes</a> -->
         
          <a href="{{url('/admin/quotes')}}" class="nav-item nav-link {{ request()->is('admin/quotes') ? 'active' : '' }}"><i class="fa-solid fa-quote-left me-2"></i>Quote Records</a>
          <!-- <a href="{{url('/admin/today-orders')}}" class="nav-item nav-link {{ request()->is('admin/today-orders') ? 'active' : '' }}"><i class="fa-solid fa-box me-2"></i>Today's Orders</a> -->
           
          
          <a href="{{url('/admin/orders')}}" class="nav-item nav-link {{ request()->is('admin/orders') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked me-2"></i>
            Order Records</a>
         
          <a href="{{url('/admin/vector-orders')}}" class="nav-item nav-link {{ request()->is('admin/vector-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
            Vector Records</a>

            <a href="{{url('/admin/my-profile')}}" class="nav-item nav-link {{ request()->is('admin/my-profile') ? 'active' : '' }}"><i class="fa-solid fa-user me-2"></i>
            My Profile</a>

            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="nav-item nav-link">
    <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
</a>

        </div>
      </nav>
    </div>
    <!-- Sidebar End -->

          <!-- page title area end -->
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
