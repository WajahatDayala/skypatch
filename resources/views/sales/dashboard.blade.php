@extends('admin.base')
@section('action-content')
<style>
  
    </style>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Today's Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-todayquotes"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/today_quote.png')}}" alt="" >
                <p class="my-2 h6">Today's Quote</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/sales/sales-today-orders"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/today_order.png')}}" alt="" >
                <p class="my-2 h6">Today's Order</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-today-vectors"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/today_vector.png')}}" alt="" >
                <p class="my-2 h6">Today's Vector</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/sales/sales-employees"> <img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/Employees.png')}}" alt="" >
                <p class="my-2 h6">Employees</p></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- All Records Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-allorders"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/all_orders.png')}}" alt="" >
                <p class="my-2 h6">All Orders</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-allquotes"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/all_quotes.png')}}" alt="">
                <p class="my-2 h6">All Quotes</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-allvectors"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/all_vectors.png')}}" alt="" >
                <p class="my-2 h6">All Vectors</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-invoices"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/invoice.png')}}" alt="" >
                <p class="my-2 h6">Invoices</p></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Customer and Reports Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/allcustomers"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/allcustomers.png')}}" alt="" >
                <p class="my-2 h6">All Customers</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/sale_Team_Report.png')}}" alt="" >
                <p class="my-2 h6">Sales Team Report</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/record_annum.png')}}" alt="" >
                <p class="my-2 h6">Record Annum</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/Sales_Annum.png')}}" alt="" >
                <p class="my-2 h6">Sales Annum</p></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Designer and Accounts Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/designer_reports.png')}}" alt="" >
                <p class="my-2 h6">Designer Reports</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/account.png')}}" alt="" >
                <p class="my-2 h6">Accounts</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/Commission.png')}}" alt="" >
                <p class="my-2 h6">Sales Commission</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/sales/sales-assign-leader"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/designer_leader.png')}}" alt="" >
                <p class="my-2 h6">Designer & Leader</p></a>
            </div>
        </div>
    </div>
 

    <div class="row g-4 mt-3">
        <!-- Designer and Accounts Section --> 

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href=""><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/edit.png')}}" alt="" >
                <p class="my-2 h6">Edit Report</p></a>
            </div>
        </div>
    </div>
</div>

@endsection
