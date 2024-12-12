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
                        <h6 class="h6 mb-0">Sales Commission</h6>
                    </div>
                </div>
                     
              
                <form action="{{route('sales-commission.result')}}" method="GET">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>From Date</label>
                        <input type="date" class="form-control" required name="from_date">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>To Date</label>
                        <input type="date" class="form-control" required name="to_date">
                        </div>
                    </div>

              

                    <div class="col-md-2 ml-6">
                     
                        <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                       
                    </div>
                    </form>

                    {{-- <div class="table-responsive">
                        <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center"> Sr# </th>
                                    <th class="text-center"> Name </th>
                                    <th class="text-center"> Count </th>
                                    <th class="text-center"> Details </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalSales =0;    
                                @endphp
                                @foreach($sales as $s)
                               
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{$s->sellerName}}</td>
                                    <td class="text-center">{{$s->total_price}}
                                        @php
                                        $totalSales +=$s->total_price;
                                        @endphp
                                    </td>
                                    <td></td>
                                  
                        
                                </tr>
                                @endforeach
    
    
    
    
    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td class="text-center">
                                        Total Sales
                                    </td>
                                    <td class="text-center">{{$totalSales}}</td>
                                    <td></td>
                                  
                                  
                                </tr>
                            </tfoot>
                        </table> --}}
                    </div>

                </div>

                


   
    </div>
</div>
<!-- Content Div Ends here End -->






<!-- Content Div Ends here End -->



@endsection