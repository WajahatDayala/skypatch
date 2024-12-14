<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VectorOrder;
use App\Models\Quote;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Admin;

class DesignReportController extends Controller
{
    //
    public function index()
    {

        $designer = Admin::select(
            '*',
            'admins.id as employeeId',
            'admins.name as employeeName'
        )
            ->join('roles', 'admins.role_id', '=', 'roles.id')
            ->whereIn(
                'roles.name',
                ['Quote Worker', 'Order Worker', 'Vector Worker']
            )
            ->get();


        if (Auth::user()->role->name === 'Admin') {
           
            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
            
        } else if (Auth::user()->role->name == 'Accounts') {

            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
        } else if (Auth::user()->role->name == 'Customer Support') {

            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
        } else if (Auth::user()->role->name == 'Sales') {

            return view('reports/accounts-user-report/designer-report/index', compact('designer'));
        }


    }
    //search sales team
    public function searchDesignerReport(Request $request)
    {

        $designer = Admin::select(
            '*',
            'admins.id as employeeId',
            'admins.name as employeeName'
        )
            ->join('roles', 'admins.role_id', '=', 'roles.id')
            ->whereIn(
                'roles.name',
                ['Quote Worker', 'Order Worker', 'Vector Worker']
            )
            ->get();

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $designerId = $request->input('designer_id', null); // Default to null if no designer is selected


        $ordersData = DB::table('admins')
        // Join the roles table to filter based on role names
        ->leftJoin('roles', 'admins.role_id', '=', 'roles.id')  // Join roles to filter by designer roles
        ->leftJoin('orders', function ($join) use ($fromDate, $toDate) {
            $join->on('orders.designer_id', '=', 'admins.id')
                ->whereBetween('orders.created_at', [$fromDate, $toDate]);  // Filter orders within the date range
        })
        ->leftJoin('quotes', 'quotes.designer_id', '=', 'admins.id')  // Join quotes table to get quote counts for each designer
        ->select(
            'admins.name as designerName',
            'admins.id as designerId',
    
            // Count distinct orders based on different order_statuses (3 for New, 4 for Free, etc.)
            DB::raw('COUNT(DISTINCT CASE WHEN orders.order_status = 3 THEN orders.id ELSE NULL END) as `New`'),
            DB::raw('COUNT(DISTINCT CASE WHEN orders.order_status = 4 THEN orders.id ELSE NULL END) as `Free`'),
            DB::raw('COUNT(DISTINCT CASE WHEN orders.order_status = 5 THEN orders.id ELSE NULL END) as `Edit`'),
            DB::raw('COUNT(DISTINCT CASE WHEN orders.order_status = 6 THEN orders.id ELSE NULL END) as `Revision`'),
            DB::raw('COUNT(DISTINCT CASE WHEN orders.quote_id != 0 THEN orders.id ELSE NULL END) as `ConvertedQuote`'),
    
            // Count total distinct orders
            DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
    
            // Count all quotes (including Edit/Revision)
            DB::raw('COUNT(DISTINCT quotes.id) as `All_Quotes`'),
    
            // Count only those quotes with status 5 (Edit) or 6 (Revision)
            DB::raw('COUNT(DISTINCT CASE WHEN quotes.quotes_status IN (5, 6) THEN quotes.id ELSE NULL END) as `Edit_Revision_Quotes`')
        )
        ->whereIn('roles.name', ['Quote Worker', 'Order Worker', 'Vector Worker'])  // Filter designers by role names
        ->groupBy('admins.id', 'admins.name')  // Group by designer ID and name
        ->get();


        //new order record 
        $newOrder = Order::select('*','orders.name as designName')
        ->whereBetween('orders.created_at',[$fromDate,$toDate])
        ->where('orders.designer_id',$designerId)
        ->where('orders.order_status',3)
        ->where('orders.status_id',1)
        ->where('orders.delete_status',0)
        ->get();

                //edit order record 
                $editOrder = Order::select('*','orders.name as designName')
                ->whereBetween('orders.created_at',[$fromDate,$toDate])
                ->where('orders.designer_id',$designerId)
                ->where('orders.order_status',5)
                ->where('orders.status_id',1)
                ->where('orders.delete_status',0)
                ->get();


                ////revision order record 
                $revisionOrder = Order::select('*','orders.name as designName')
                ->whereBetween('orders.created_at',[$fromDate,$toDate])
                ->where('orders.designer_id',$designerId)
                ->where('orders.order_status',6)
                ->where('orders.status_id',1)
                ->where('orders.delete_status',0)
                ->get();


                    ////free order record 
                $freeOrder = Order::select('*','orders.name as designName')
                        ->whereBetween('orders.created_at',[$fromDate,$toDate])
                        ->where('orders.designer_id',$designerId)
                        ->where('orders.order_status',4)
                        ->where('orders.status_id',1)
                        ->where('orders.delete_status',0)
                        ->get();

                        
                        //all quotes
                        $allquotes = Quote::select('*','quotes.name as designName')
                        ->whereBetween('quotes.created_at',[$fromDate,$toDate])
                        ->where('quotes.designer_id',$designerId)
                       // ->where('quotes.quotes_status',4)
                        ->where('quotes.status_id',1)
                        ->where('quotes.delete_status',0)
                        ->get();

                         //edit quotes
                        $editquotes = Quote::select('*','quotes.name as designName')
                        ->whereBetween('quotes.created_at',[$fromDate,$toDate])
                        ->where('quotes.designer_id',$designerId)
                        ->where('quotes.quotes_status',5)
                        ->where('quotes.status_id',1)
                        ->where('quotes.delete_status',0)
                        ->get();


                        $convertQuoteToOrder = Order::select('*', 'orders.name as designName')
                        ->whereBetween('orders.created_at', [$fromDate, $toDate])
                        ->where('orders.designer_id', $designerId)
                        ->where('orders.status_id', 2)
                        ->where('orders.delete_status', 0)
                        ->whereNotNull('orders.quote_id')
                        ->get();
                    
                   

        // Return the data to the view
        return view(
            'reports/accounts-user-report/designer-report/search',
            compact(
                'ordersData', 
                'designer',
                'newOrder',
                'editOrder',
                'revisionOrder',
                'freeOrder',
                'allquotes',
                'editquotes',
                'convertQuoteToOrder'

                )
        );

    }
}
