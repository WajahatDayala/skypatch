<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class AsignLeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $redirectTo = '/assing-leaders';
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    
    public function index()
    {
        //
        $employee = Admin::select('*','admins.id as employeeId', 'admins.name as employeeName', 'roles.name as roles','admins.leader_id', 'leaders.name as leaderName')
        ->leftJoin('admins as leaders', 'admins.leader_id', '=', 'leaders.id') // Join to get leader name
        ->join('roles', 'admins.role_id', '=', 'roles.id')
        ->whereIn('roles.name', 
        ['Quote Digitizer Worker', 'Order Digitizer Worker', 'Vector Digitizer Worker'])
        ->get();

        //all leaders 
        $leaders = Admin::select('*', 'admins.name as leaderName', 'roles.name as roles')
        ->join('roles', 'admins.role_id', '=', 'roles.id')
        ->whereIn('roles.name',
         ['Quote Digitizer Leader', 'Order Digitizer Leader', 'Vector Digitizer Leader'])
        ->get();
      
        return view('admin.assignleaders.index',[
            'employee'=>$employee,
            'leaders'=>$leaders
        ]);
    }

    //asign Leader
    public function assignLeader(Request $request, $id)
    {
        $request->validate([
            'leader_id' => 'required|exists:admins,id', // Adjust according to your leaders table
          ]);
    
          $admin = Admin::findOrFail($id);
          $admin->leader_id = $request->leader_id;
          $admin->save();
    
         return redirect()->back()->with('success', 'Leader assigned successfully!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}