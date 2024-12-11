<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;
use Auth;

class SalesTeamReportController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->name === 'Admin') {
          //  return redirect()->route('support-allorders.show',$request->order_id)->with('success', 'Order updated successfully!');

        } else if (Auth::user()->role->name == 'Accounts') {

            return view('reports/accounts-user-report/sales-team/index');
        }
        else if (Auth::user()->role->name == 'Customer Support') {

            return view('reports/accounts-user-report/sale-team/index');
        }
         else if (Auth::user()->role->name == 'Sales') {

         //   return redirect()->route('sales-allorders.show', $request->order_id)->with('success', 'Order created successfully!');
        }

      
    }
    //search sales team
    public function searchSalesTeam(Request $request)
    {

        $sales = InvoiceDetail::select('admins.name as sellerName',
         DB::raw('SUM(invoice_details.price) as total_price'))
        ->join('admins', 'invoice_details.seller_id', '=', 'admins.id')
        ->where('admins.role_id', '!=', 1)  
        ->where('invoice_details.paid_on', 1)  
        ->whereBetween('invoice_details.released_date', [$request->from_date, $request->to_date])
        ->groupBy('admins.name') 
        ->get();

        return view('reports/accounts-user-report/sales-team/search',compact('sales'));
       
        
    }


    
}
