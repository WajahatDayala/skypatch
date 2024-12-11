<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class AccountAssignLeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee = Admin::select('*',
        'admins.id as employeeId',
         'admins.name as employeeName', 
         'roles.name as roles','admins.leader_id', 
         'leaders.name as leaderName')
        ->leftJoin('admins as leaders', 'admins.leader_id', '=', 'leaders.id') // Join to get leader name
        ->join('roles', 'admins.role_id', '=', 'roles.id')
        ->whereIn('roles.name', 
        ['Quote Worker', 'Order Worker', 'Vector Worker'])
        ->get();

        //all leaders 
        $leaders = Admin::select('*', 'admins.name as leaderName', 'roles.name as roles')
        ->join('roles', 'admins.role_id', '=', 'roles.id')
        ->whereIn('roles.name',
         ['Quote Leader', 'Order Leader', 'Vector Leader'])
        ->get();
      
        return view('admin.assignleaders.index',[
            'employee'=>$employee,
            'leaders'=>$leaders
        ]);
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
