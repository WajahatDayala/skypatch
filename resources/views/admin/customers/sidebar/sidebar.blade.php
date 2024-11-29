   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-outer navbar-light d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <a href="index.html" class="d-flex align-items-center justify-content-center">
          <img src="{{asset('skypatch/img/logowhite.png')}}" alt="skypatch_logo" />
          </a>
          
          <div class="my-3 d-flex flex-column align-items-center justify-content-center">
            <h6 class="mb-0 h4 text-white customer-name">{{$user->name}}</h6>
            <span class="h6  text-light fw-light">Customer</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
        <a href="{{ url('customers/' . $user->id . '/dashboard') }}" class="nav-item nav-link {{ request()->is('customers/' . $user->id . '/dashboard') ? 'active' : '' }}">
        <i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
        
            
            <a href="{{ url('customers/' . $user->id . '/quote') }}" class="nav-item nav-link {{ request()->is('customers/' . $user->id . '/quote') ? 'active' : '' }}"><i class="fa-solid fa-quote-right me-2"></i>
            Send Quotes</a>
            
            <a href="{{ url('customers/' . $user->id . '/order') }}" class="nav-item nav-link {{ request()->is('customers/' . $user->id . '/order') ? 'active' : '' }}"><i class="fa-solid fa-box me-2"></i>Place Orders</a>
            <a href="{{ url('customers/' . $user->id . '/vector-order') }}" class="nav-item nav-link {{ request()->is('customers/' . $user->id . '/vector-order') ? 'active' : '' }}"><i class="fa-regular fa-pen-to-square me-2"></i></i>
            Place Vector Orders</a>
           
         
          <a href="{{ url('customers/' . $user->id . '/all-quotes') }}" class="nav-item nav-link {{ request()->is('customers/' . $user->id . '/all-quotes') ? 'active' : '' }}"><i class="fa-solid fa-quote-left me-2"></i>Quote Records</a>
          
       
          <a href="{{url('customers/'.$user->id.'/all-orders')}}" class="nav-item nav-link {{ request()->is('customers/'.$user->id.'/all-orders') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked me-2"></i>
            Order Records</a>
         
          <a href="{{url('customers/'.$user->id.'/all-vector-orders')}}" class="nav-item nav-link {{ request()->is('customers/'.$user->id.'/all-vector-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
            Vector Records</a>

            <a href="{{url('customers/'.$user->id.'/my-profile')}}" class="nav-item nav-link {{ request()->is('customers/'.$user->id.'/my-profile') ? 'active' : '' }}"><i class="fa-solid fa-user me-2"></i>
            My Profile</a>

          <!-- <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a> -->


        </div>
      </nav>
    </div>
    <!-- Sidebar End -->
           <!-- page title area end -->
           <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form> -->