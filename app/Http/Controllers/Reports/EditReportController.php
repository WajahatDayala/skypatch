<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ReasonEdit;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EditReportController extends Controller
{
    //
    public function index()
    {

        $reasons = ReasonEdit::all();
        $currentMonthName = Carbon::now()->format('F');  // 'F' returns the full month name (e.g., January, February)
   
        $currentMonthNum = Carbon::now()->month;  // Get the numeric month (1-12)

        // Retrieve reasons and their order counts for the current month
        $ordersReasons = Order::select('reason_edits.reason as reasonName', \DB::raw('count(*) as order_count'))
            ->join('reason_edits', 'orders.edit_reason_id', '=', 'reason_edits.id')
            ->whereMonth('orders.created_at', $currentMonthNum)  // Use numeric month here
            ->where('orders.edit_reason_id','!=',12)
            ->groupBy('reason_edits.reason')
            ->get();

            $notmentionReasons = Order::select(
                \DB::raw('COALESCE(reason_edits.reason, "No Reason Specified") as reason'),  // Handle null reasons
                \DB::raw('COUNT(orders.id) as others')  // Count orders properly
            )
                ->join('reason_edits', 'orders.edit_reason_id', '=', 'reason_edits.id')  // LEFT JOIN to include orders with null edit_reason_id
                ->whereMonth('orders.created_at', $currentMonthNum)  // Filter by current month
                ->where(function ($query) {
                    $query->where('orders.edit_reason_id', 12)  // For orders with edit_reason_id = 12
                          ->orWhereNull('orders.edit_reason_id');  // For orders with null edit_reason_id
                })
                ->groupBy('reason_edits.reason')  // Group by reason (can be null for edit_reason_id = null)
                ->get();
          
     

        if (Auth::user()->role->name === 'Admin') {
           
            return view('reports/accounts-user-report/edit-report/index', 
            compact(
                'reasons',
                'currentMonthName',
                'ordersReasons',
                'notmentionReasons'
            ));
            
        } else if (Auth::user()->role->name == 'Accounts') {

            return view('reports/accounts-user-report/edit-report/index', 
            compact(
                'reasons',
                'currentMonthName',
                'ordersReasons',
                'notmentionReasons'
            ));

        } else if (Auth::user()->role->name == 'Customer Support') {

              return view('reports/accounts-user-report/edit-report/index', 
            compact(
                'reasons',
                'currentMonthName',
                'ordersReasons',
                'notmentionReasons'
            ));

        } else if (Auth::user()->role->name == 'Sales') {

              return view('reports/accounts-user-report/edit-report/index', 
            compact(
                'reasons',
                'currentMonthName',
                'ordersReasons',
                'notmentionReasons'
            ));
        }


    }

    //search edit Reports
    public function searchEditReport(Request $request)
    {
     
        $reasons = ReasonEdit::all();
        $currentMonthName = Carbon::now()->format('F');  // 'F' returns the full month name (e.g., January, February)
   
        $currentMonthNum = Carbon::now()->month;  // Get the numeric month (1-12)

        // Retrieve reasons and their order counts for the current month
        $ordersReasons = Order::select('reason_edits.reason as reasonName', \DB::raw('count(*) as order_count'))
            ->join('reason_edits', 'orders.edit_reason_id', '=', 'reason_edits.id')
            ->whereMonth('orders.created_at', $currentMonthNum)  // Use numeric month here
            ->where('orders.edit_reason_id','!=',12)
            ->groupBy('reason_edits.reason')
            ->get();

            $notmentionReasons = Order::select(
                \DB::raw('COALESCE(reason_edits.reason, "No Reason Specified") as reason'),  // Handle null reasons
                \DB::raw('COUNT(orders.id) as others')  // Count orders properly
            )
                ->join('reason_edits', 'orders.edit_reason_id', '=', 'reason_edits.id')  // LEFT JOIN to include orders with null edit_reason_id
                ->whereMonth('orders.created_at', $currentMonthNum)  // Filter by current month
                ->where(function ($query) {
                    $query->where('orders.edit_reason_id', 12)  // For orders with edit_reason_id = 12
                          ->orWhereNull('orders.edit_reason_id');  // For orders with null edit_reason_id
                })
                ->groupBy('reason_edits.reason')  // Group by reason (can be null for edit_reason_id = null)
                ->get();
        
                $order = Order::select(
                    'orders.id', 
                    'reason_edits.reason as reasonName', 
                    'admins.name as designerName', 
                    'orders.created_at'
                )
                ->join('reason_edits', 'orders.edit_reason_id', '=', 'reason_edits.id')
                ->join('admins', 'orders.designer_id', '=', 'admins.id')
                ->whereBetween('orders.created_at', [$request->from_date, $request->to_date]);
    
    // Apply the reason_id filter only if it's set
    if (!empty($request->reason_id)) {
        $order->where('orders.edit_reason_id', $request->reason_id);  // Filter by reason_id if it's provided
    }
    
    // Execute the query and get the result
    $order = $order->get();  // Execute the query here

     

        return view('reports/accounts-user-report/edit-report/search', 
        compact(
            'order',
            'reasons',
                'currentMonthName',
                'ordersReasons',
                'notmentionReasons'
        ));
      

    }





}
