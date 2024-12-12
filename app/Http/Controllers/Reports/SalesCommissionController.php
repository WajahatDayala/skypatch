<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesCommissionController extends Controller
{
    //
    public function index()
    {
        return view('reports.accounts-user-report.sales-commission.index');
    }

    public function searchCommission(Request $request)
    {
        return view('reports.accounts-user-report.sales-commission.search');
    }

    
}
