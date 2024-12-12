<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ReasonEdit;


class EditReportController extends Controller
{
    //
    public function index()
    {

        $reasons = ReasonEdit::all();

        if (Auth::user()->role->name === 'Admin') {
           
            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
            
        } else if (Auth::user()->role->name == 'Accounts') {

            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
        } else if (Auth::user()->role->name == 'Customer Support') {

            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
        } else if (Auth::user()->role->name == 'Sales') {

            return view('reports/accounts-user-report/edit-report/index', compact('designer'));
        }


    }

    public function searchEditReport(Request $request)
    {

    }





}
