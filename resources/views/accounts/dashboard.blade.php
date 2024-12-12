@extends('accounts.base')
@section('action-content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Today's Section -->
        <!-- Today's Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/account-todayquotes"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/today_quote.png')}}" alt="" >
                <p class="my-2 h6">Today's Quote</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/accounts/account-today-orders"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/today_order.png')}}" alt="" >
                <p class="my-2 h6">Today's Order</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/account-today-vector"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/today_vector.png')}}" alt="" >
                <p class="my-2 h6">Today's Vector</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
            <a href="/accounts/account-employees"> <img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/Employees.png')}}" alt="" >
                <p class="my-2 h6">Employees</p></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- All Records Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/account-allorders"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/all_orders.png')}}" alt="" >
                <p class="my-2 h6">All Orders</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/account-allquotes"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/all_quotes.png')}}" alt="">
                <p class="my-2 h6">All Quotes</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/account-allorders"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/all_vectors.png')}}" alt="" >
                <p class="my-2 h6">All Vectors</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/accounts-invoices"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/invoice.png')}}" alt="" >
                <p class="my-2 h6">Invoices</p></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Customer and Reports Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/allcustomers"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/allcustomers.png')}}" alt="" >
                <p class="my-2 h6">All Customers</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/sales-team"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/sale_Team_Report.png')}}" alt="" >
                <p class="my-2 h6">Sales Team Report</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/record-annum"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/record_annum.png')}}" alt="" >
                <p class="my-2 h6">Record Annum</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/sales-annum"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/Sales_Annum.png')}}" alt="" >
                <p class="my-2 h6">Sales Annum</p></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Designer and Accounts Section -->
        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/designer-report"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/designer_reports.png')}}" alt="" >
                <p class="my-2 h6">Designer Reports</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/account-report"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/account.png')}}" alt="" >
                <p class="my-2 h6">Accounts</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/sales-commission"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/Commission.png')}}" alt="" >
                <p class="my-2 h6">Sales Commission</p></a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/accounts/accounts-assign-leader"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/designer_leader.png')}}" alt="" >
                <p class="my-2 h6">Designer & Leader</p></a>
            </div>
        </div>
    </div>


    <div class="row g-4 mt-3">
        <!-- Designer and Accounts Section --> 

        <div class="col-sm-6 col-md-3 col-xl-3">
            <div class="rounded card shadow-lg border d-flex flex-column align-items-center justify-content-center p-4">
                <a href="/reports/edit-report"><img class="icon-img-dashboard" src="{{asset('skypatch/img/admin/edit.png')}}" alt="" >
                <p class="my-2 h6">Edit Report</p></a>
            </div>
        </div>
    </div>
</div>

     

@endsection
