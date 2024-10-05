   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-outer navbar-light d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
          <a href="index.html" class="d-flex align-items-center justify-content-center">
            <img src="  {{asset('skypatch/img/logo_resized.png')}}" alt="skypatch_logo" />
          </a>
          
          <div class="my-3 d-flex flex-column align-items-center justify-content-center">
            <h6 class="mb-0 h4">{{Auth()->user()->name}}</h6>
            <span class="h6 text-light fw-light">Customer</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
          <a href="TodaysQuote.html" class="nav-item nav-link"><i class="fa-solid fa-quote-right me-2"></i>
            Today's Quotes</a>
          <a href="AllQuotes.html" class="nav-item nav-link"><i class="fa-solid fa-quote-left me-2"></i>All Quotes</a>
          <a href="TodaysOrder.html" class="nav-item nav-link"><i class="fa-solid fa-box me-2"></i>Today's Orders</a>
          <a href="TodaysEditOrder.html" class="nav-item nav-link"><i class="fa-solid fa-box-open me-2"></i>Today's Edit
            Orders</a>
          <a href="AllOrders.html" class="nav-item nav-link"><i class="fa-solid fa-boxes-stacked me-2"></i>All
            Orders</a>
          <a href="AllOrders.html" class="nav-item nav-link"><i class="fa-regular fa-pen-to-square me-2"></i></i>Today's
            Vector</a>
          <a href="AllOrders.html" class="nav-item nav-link"><i class="fa-solid fa-pen-to-square me-2"></i>All
            Vectors</a>
          <a href="widget.html" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>


        </div>
      </nav>
    </div>
    <!-- Sidebar End -->
