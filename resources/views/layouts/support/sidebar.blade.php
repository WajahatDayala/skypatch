   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-outer navbar-light d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <a href="index.html" class="d-flex align-items-center justify-content-center">
          <img src="{{asset('skypatch/img/logowhite.png')}}" alt="skypatch_logo" />

          </a>
          
          <div class="my-3 d-flex flex-column align-items-center justify-content-center">
            <h6 class="mb-0 h4 text-white customer-name">{{Auth()->user()->name}}</h6>
            <span class="h6  text-white fw-light">{{Auth()->user()->role->name}}</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a href="{{url('/support/dashboard')}}" class="nav-item nav-link  {{ request()->is('support/dashboard') ? 'active' : '' }}" ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          
        


          <a href="{{url('/support/allcustomers')}}" class="nav-item nav-link {{ request()->is('support/allcustomers') ? 'active' : '' }}"><i class="fa-solid fa-box me-2"></i>All Customers</a>
           
          <a href="{{url('/support/support-todayquotes')}}" class="nav-item nav-link {{ request()->is('support/support-todayquotes') ? 'active' : '' }}"><i class="fa-solid fa-quote-left me-2"></i>Today's Quote</a>
         
           
          <a href="{{url('/support/supportquotes')}}" class="nav-item nav-link {{ request()->is('support/supportquotes') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked me-2"></i>
          All Quotes</a>
         
          <a href="{{url('/support/support-today-orders')}}" class="nav-item nav-link {{ request()->is('support/support-today-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
          Today's Order </a>

          <a href="{{url('/support/support-today-edit-orders')}}" class="nav-item nav-link {{ request()->is('support/support-today-edit-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
          Today's Edit Order </a>

          <a href="{{url('/support/support-allorders')}}" class="nav-item nav-link {{ request()->is('support/support-allorders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
          All Orders</a>
        
          <a href="{{url('/support/support-vector-today-orders')}}" class="nav-item nav-link {{ request()->is('support/support-vector-today-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
          Today's Vector</a>

          <a href="{{url('/support/support-vector-orders')}}" class="nav-item nav-link {{ request()->is('support/support-vector-orders') ? 'active' : '' }}"><i class="fa-solid fa-pen-to-square me-2"></i>
          All Vector </a>
          
         
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
