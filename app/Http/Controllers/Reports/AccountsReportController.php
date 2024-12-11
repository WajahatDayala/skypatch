<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Admin;

class AccountsReportController extends Controller
{
    //

    public function index()
    {

        return view('reports.accounts-user-report.accounts-report.index');
    }

    public function searchAccount(Request $request)
    {
        
    }
}
