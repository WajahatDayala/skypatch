@extends('reports.base')
@section('action-content')



<!-- All Content Goes inside this div -->
<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
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

                    {{-- <div class="col-md-3">
                        <div class="form-group">
                        <label>Billing Type</label>
                        
                        <select class="form-control" name="designer_id">
                            <option value="">Credit Card</option> <!-- Default option with empty value -->
                            <option value="">All</option>
                               
                        </select>

                        </div>
                    </div> --}}

              

                    <div class="col-md-2 ml-6">
                     
                        <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                       
                    </div>
                    

                    </form>
                </div>

                


   
    </div>
</div>
<!-- Content Div Ends here End -->






<!-- Content Div Ends here End -->



@endsection