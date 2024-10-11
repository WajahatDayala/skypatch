   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-outer navbar-light d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <a href="index.html" class="d-flex align-items-center justify-content-center">
            <img src="  {{asset('skypatch/img/logo_resized.png')}}" alt="skypatch_logo" />
          </a>
          
          <div class="my-3 d-flex flex-column align-items-center justify-content-center">
            <h6 class="mb-0 h4 customer-name">{{Auth()->user()->name}}</h6>
            <span class="h6  text-light fw-light">Customer</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a href="{{url('/dashboard')}}" class="nav-item nav-link  {{ request()->is('dashboard') ? 'active' : '' }}" ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          <!-- <a href="{{url('/customer/today-quotes')}}" class="nav-item nav-link {{ request()->is('customer/today-quotes') ? 'active' : '' }}"><i class="fa-solid fa-quote-right me-2"></i>
            Today's Quotes</a> -->
            <a href="{{url('/customer/quotes/create')}}" class="nav-item nav-link {{ request()->is('customer/quotes/create') ? 'active' : '' }}"><i class="fa-solid fa-quote-right me-2"></i>
            Send Quotes</a>

            <a href="{{url('/customer/orders/create')}}" class="nav-item nav-link {{ request()->is('customer/orders/create') ? 'active' : '' }}"><i class="fa-solid fa-box me-2"></i>Place Orders</a>
            <a href="{{url('/customer/vector-orders/create')}}" class="nav-item nav-link {{ request()->is('customer/vector-orders/create') ? 'active' : '' }}"><i class="fa-regular fa-pen-to-square me-2"></i></i>
            Place Vector Orders</a>
          <a href="{{url('/customer/quotes')}}" class="nav-item nav-link {{ request()->is('customer/quotes') ? 'active' : '' }}"><i class="fa-solid fa-quote-left me-2"></i>Quote Records</a>
          <!-- <a href="{{url('/customer/today-orders')}}" class="nav-item nav-link {{ request()->is('customer/today-orders') ? 'active' : '' }}"><i class="fa-solid fa-box me-2"></i>Today's Orders</a> -->
            <!-- <a href="TodaysEditOrder.html" class="nav-item nav-link"><i class="fa-solid fa-box-open me-2"></i>Today's Edit
              Orders</a> -->
          
          <a href="{{url('/customer/orders')}}" class="nav-item nav-link {{ request()->is('customer/orders') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked me-2"></i>
            Order Records</a>
         
          <a href="{{url('/customer/vector-orders')}}" class="nav-item nav-link {{ request()->is('customer/vector-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
            Vector Records</a>

            <a href="{{url('/customer/my-profile')}}" class="nav-item nav-link {{ request()->is('customer/my-profile') ? 'active' : '' }}"><i class="fa-solid fa-user me-2"></i>
            My Profile</a>

          <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>


        </div>
      </nav>
    </div>
    <!-- Sidebar End -->
