<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class SalesAnnumController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->name === 'Admin') {
            //  return redirect()->route('support-allorders.show',$request->order_id)->with('success', 'Order updated successfully!');
  
          } else if (Auth::user()->role->name == 'Accounts') {
  
              return view('reports/accounts-user-report/sales-annum/index');
          }
          else if (Auth::user()->role->name == 'Customer Support') {
  
              return view('reports/accounts-user-report/sale-team/index');
          }
           else if (Auth::user()->role->name == 'Sales') {
  
           //   return redirect()->route('sales-allorders.show', $request->order_id)->with('success', 'Order created successfully!');
          }
    }

    public function searchSalesAnnum(Request $request)
    {
        $year = $request->input('from_date', date('Y')); // Get the selected year

        // Define months array for use in the view
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        
        $ordersData = DB::table('users')
            // Left join invoices and invoice_details
            ->leftJoin('invoices', 'invoices.customer_id', '=', 'users.id')
            ->leftJoin('invoice_details', 'invoice_details.invoice_id', '=', 'invoices.id')
            
            // Apply filters for the selected year and paid status
            ->whereYear('invoice_details.released_date', $year)
            ->where(function ($query) {
                $query->where('invoice_details.paid_on', 1)
                      ->orWhereNull('invoice_details.id'); // Include customers who have no invoice details
            })
            ->select(
                'users.name as customer_name',
        
                // Sum price for each customer per month from invoice_details table
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 1 THEN invoice_details.price ELSE 0 END) as `Jan`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 2 THEN invoice_details.price ELSE 0 END) as `Feb`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 3 THEN invoice_details.price ELSE 0 END) as `Mar`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 4 THEN invoice_details.price ELSE 0 END) as `Apr`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 5 THEN invoice_details.price ELSE 0 END) as `May`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 6 THEN invoice_details.price ELSE 0 END) as `Jun`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 7 THEN invoice_details.price ELSE 0 END) as `Jul`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 8 THEN invoice_details.price ELSE 0 END) as `Aug`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 9 THEN invoice_details.price ELSE 0 END) as `Sep`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 10 THEN invoice_details.price ELSE 0 END) as `Oct`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 11 THEN invoice_details.price ELSE 0 END) as `Nov`'),
                DB::raw('SUM(CASE WHEN MONTH(invoice_details.released_date) = 12 THEN invoice_details.price ELSE 0 END) as `Dec`'),
        
                // Count total sales (sum of all prices) per customer for the year
                DB::raw('SUM(invoice_details.price) as total_sales')
            )
            ->groupBy('users.id', 'users.name') // Group by user ID and name
            ->get();
        
    
    

        // Return the data to the view
        return view('reports/accounts-user-report/sales-annum/search', compact('ordersData', 'year', 'months'));
    
    }
}
