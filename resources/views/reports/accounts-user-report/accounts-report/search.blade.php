@extends('reports.base')
@section('action-content')



<!-- All Content Goes inside this div -->
<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Accounts Report</h6>
                    </div>
                </div>
                     
              
                <form action="{{route('account-report.result')}}" method="GET">
                      
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>From Date</label>
                            <input type="date" class="form-control" required name="from_date">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>To Date</label>
                            <input type="date" class="form-control" required name="to_date">
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Billing Type</label>

                                <select class="form-control" name="billing_type">
                                    <option value="">All Billing Type</option>
                                    @foreach ($billingTypes as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
              

                    <div class="col-md-2 ml-6">
                     
                        <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                       
                    </div>
                    </form>

                    <div class="table-responsive">
                        <table id="dataTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">S #</th>
                                    <th class="text-center">Order #</th>
                                    <th class="text-center">Design Name</th>
                                    <th class="text-center">Customer Nick</th>
                                    <th class="text-center">Billing Type</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $iterationCount = 1; // Initialize iteration counter
                                @endphp
                    
                                <!-- Loop through orders -->
                                @foreach($orders as $s)
                                    @if($s->order_id)
                                    <tr>
                                        <td class="text-center">{{ $iterationCount }}</td>
                                        <td class="text-center">{{$s->design_number}}</td>
                                        <td class="text-center">{{$s->design_name}}</td>
                                        <td class="text-center">
                                            {{-- @if(Auth::user()->role->name === 'Admin')       
                                                {{$s->customer_name}}
                                            @endif --}}
                                            {{$s->customer_name}}
                                        </td>
                                        <td class="text-center">{{$s->billingType}}</td>
                                        <td class="text-center">{{$s->createdAt}}</td>
                                        <td class="text-center">{{$s->action_date}}</td>
                                    </tr>
                                    @php
                                    $iterationCount++;
                                    @endphp
                                    @endif
                                @endforeach
                    
                                <!-- Loop through vectorOrders -->
                                @foreach($vectorOrders as $s)
                                    @if($s->vector_id)
                                    <tr>
                                        <td class="text-center">{{ $iterationCount }}</td>
                                        <td class="text-center">{{$s->design_number}}</td>
                                        <td class="text-center">{{$s->design_name}}</td>
                                        <td class="text-center">
                                            {{-- @if(Auth::user()->role->name === 'Admin')       
                                                {{$s->customer_name}}
                                            @endif --}}
                                            {{$s->customer_name}}
                                        </td>
                                        <td class="text-center">{{$s->billingType}}</td>
                                        <td class="text-center">{{$s->createdAt}}</td>
                                        <td class="text-center">{{$s->action_date}}</td>
                                    </tr>
                                    @php
                                    $iterationCount++;  // Increment iteration counter
                                    @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>

                


   
    </div>
</div>
<!-- Content Div Ends here End -->






<!-- Content Div Ends here End -->



@endsection