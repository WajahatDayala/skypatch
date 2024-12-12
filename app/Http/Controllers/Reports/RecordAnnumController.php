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

class RecordAnnumController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role->name === 'Admin') {
        
            return view('reports/accounts-user-report/record-annum/index');
            
        } else if (Auth::user()->role->name == 'Accounts') {

            return view('reports/accounts-user-report/record-annum/index');
        }
        else if (Auth::user()->role->name == 'Customer Support') {

            return view('reports/accounts-user-report/record-annum/index');
        }
         else if (Auth::user()->role->name == 'Sales') {

            return view('reports/accounts-user-report/record-annum/index');
        }

      
    }
    //search sales team
    public function searchRecordAnnum(Request $request)
    {
        // Get the selected year from the request, or default to current year
        $year = $request->input('from_date', date('Y')); // Get the selected year

            // Define months array for use in the view
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        $ordersData = DB::table('users')
        ->leftJoin('orders', function($join) use ($year) {
            // This will still perform the left join on orders for the given year
            $join->on('orders.customer_id', '=', 'users.id')
                ->whereYear('orders.created_at', $year);  // Filter orders for the given year
        })
        ->select(
            'users.name as customer_name',
        
            // Count distinct orders per customer for each month in the 'orders' table
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 1 THEN orders.id ELSE NULL END) as `Jan`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 2 THEN orders.id ELSE NULL END) as `Feb`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 3 THEN orders.id ELSE NULL END) as `Mar`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 4 THEN orders.id ELSE NULL END) as `Apr`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 5 THEN orders.id ELSE NULL END) as `May`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 6 THEN orders.id ELSE NULL END) as `Jun`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 7 THEN orders.id ELSE NULL END) as `Jul`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 8 THEN orders.id ELSE NULL END) as `Aug`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 9 THEN orders.id ELSE NULL END) as `Sep`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 10 THEN orders.id ELSE NULL END) as `Oct`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 11 THEN orders.id ELSE NULL END) as `Nov`'),
            DB::raw('COUNT(DISTINCT CASE WHEN MONTH(orders.created_at) = 12 THEN orders.id ELSE NULL END) as `Dec`'),
        
            // Count total distinct orders for the customer
            DB::raw('COUNT(DISTINCT orders.id) as total_orders')
        )
        ->groupBy('users.id', 'users.name')  // Group by user ID and name
        ->where(function ($query) {
            // Ensure that we only consider customers who have orders with status_id = 1
            $query->where('orders.status_id', 1);
                //->orWhereNull('orders.id');  // Include customers who have no orders (orders.id is NULL)
        })
        ->get();
    
    
    

        // Return the data to the view
        return view('reports/accounts-user-report/record-annum/search', compact('ordersData', 'year', 'months'));
    
    }
}
