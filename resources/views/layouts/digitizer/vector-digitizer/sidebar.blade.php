   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-outer navbar-light d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <a href="index.html" class="d-flex align-items-center justify-content-center">
          <img src="{{asset('skypatch/img/logowhite.png')}}" alt="skypatch_logo" />
          </a>
          
          <div class="my-3 d-flex flex-column align-items-center justify-content-center">
            <h6 class="mb-0 h4 text-white customer-name">{{Auth()->user()->name}}</h6>
            <span class="h6  text-light fw-light">{{Auth()->user()->role->name}}</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <!--worker-->
          @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Vector Worker')
          <a href="{{url('/vector-worker/dashboard')}}" class="nav-item nav-link  {{ request()->is('vector-worker/dashboard') ? 'active' : '' }}" ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          <a href="{{url('/vector-worker/today-worker-vector-order')}}" class="nav-item nav-link {{ request()->is('vector-worker/today-worker-vector-order') ? 'active' : '' }}"><i class="fa-solid fa-quote-left me-2"></i>Today's Order</a>
          <a href="{{url('/vector-worker/all-worker-vector-order')}}" class="nav-item nav-link {{ request()->is('vector-worker/all-worker-vector-order') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked me-2"></i>
          All Orders</a>
          <!--Leader-->
          @elseif(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Vector Leader')
          <a href="{{url('/vector-leader/dashboard')}}" class="nav-item nav-link  {{ request()->is('vector-leader/dashboard') ? 'active' : '' }}" ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          <a href="{{url('/vector-leader/today-leader-vector-order')}}" class="nav-item nav-link {{ request()->is('vector-leader/today-leader-vector-order') ? 'active' : '' }}"><i class="fa-solid fa-quote-left me-2"></i>Today's Vector</a>
          <a href="{{url('/vector-leader/all-leader-vector-order')}}" class="nav-item nav-link {{ request()->is('vector-leader/all-leader-vector-order') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked me-2"></i>
            All Vector Orders</a>
          @endif
         
        
       
         
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
