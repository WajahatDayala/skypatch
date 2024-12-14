@extends('reports.base')
@section('action-content')



<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">

        
        <div class="col-12">
            
        <div class="card shadow">
            <div class="card-header">
             <span class="text-dark"> <b>Edit Summary For {{$currentMonthName}}</b>
             </span>
            </div>
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p class="card-text">
                <div class="alert alert-primary" role="alert">
                   <div class="row">
                    <div class="col-md-6"><b class="text-dark">Not Mentioned</b></div>
                    <div class="col-md-4">
                        @foreach ($notmentionReasons as $m)
                        @if($m->others == Null || $m->others == '')
                        <span class="text-center text-dark d-inline"><b>0</b></span>
                        @else
                        <span class="text-center text-dark d-inline"><b>{{ $m->others }}</b></span>
                        @endif
                        @endforeach
                    </div>
                   </div>
                </div>

               
                
              </p>
              @foreach($ordersReasons as $or)
              <div class="row mt-3">
                  <!-- Reason Name Column -->
                  <div class="col-md-6">
                      <b class="text-primary m-3">
                          <a href="">{{ $or->reasonName }}</a>
                      </b>
                  </div>
                  
                  <!-- Order Count Column -->
                  <div class="col-md-6">
                      <span class="text-center text-dark d-inline m-3"><b>{{ $or->order_count }}</b></span>
                  </div>
              </div>
          @endforeach
          
           
          </div>
        </div>
        <div class="col-12 mt-4">
            
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Edit Report</h6>
                    </div>
                </div>
                     
              
                    <form action="{{route('edit-report.result')}}" method="GET">
                      
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
                        <label>Select Reasons</label>
                        
                        <select class="form-control" name="reason_id">
                            <option value="">All Reasons</option> <!-- Default option with empty value -->
                            @foreach($reasons as $d)
                                <option value="{{ $d->id }}">{{ $d->reason }}</option>
                            @endforeach
                        </select>

                        </div>
                    </div>

              

                    <div class="col-md-2 ml-6">
                     
                        <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                       
                    </div>
                    

                    </form>
                </div>

                
                <div class="table-responsive">
                    <table id="dataTable" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Designer</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $s)
                                <tr>
                                    <td class="text-center">{{ $s->id }}</td> 
                                    <td class="text-center">{{ $s->reasonName }}</td>
                                    <td class="text-center">{{ $s->designerName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


   
    </div>

    
</div>
<!-- Content Div Ends here End -->






@endsection