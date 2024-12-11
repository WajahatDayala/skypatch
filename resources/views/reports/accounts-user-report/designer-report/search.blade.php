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
                        <h6 class="h6 mb-0">Sales Team Report</h6>
                    </div>
                </div>
                     
              
                <form action="{{route('designer-report.result')}}" method="GET">
                      
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
                            <label>Select Designer</label>
                            
                            <select class="form-control" name="designer_id">
                                <option value="">All Designer</option> <!-- Default option with empty value -->
                                @foreach($designer as $d)
                                    <option value="{{ $d->employeeId }}">{{ $d->employeeName }}</option>
                                @endforeach
                            </select>
    
                            </div>
                        </div>
              

                    <div class="col-md-2 ml-6">
                     
                        <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                       
                    </div>
                    </form>

                    <div class="table-responsive">
                        <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center"> ID </th>
                                    <th class="text-center"> Name </th>
                                    <th class="text-center"> Free </th>
                                    <th class="text-center"> Edit </th>
                                    <th class="text-center"> New </th>
                                    <th class="text-center"> Revision </th>
                                    <th class="text-center"> All Quotes (including edit/revision) </th>
                                    <th class="text-center"> Edit/Revision </th>
                                    <th class="text-center"> Converted Quotes </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalSales =0;    
                                @endphp
                                @foreach($ordersData as $s)
                               
                                <tr>
                                    {{-- <td class="text-center">{{ $loop->iteration }}</td> --}}
                                    <td class="text-center">{{ $s->designerId }}</td> 
                                    <td class="text-center">{{$s->designerName}}</td>
                                   <td class="text-center">{{$s->Free}}</td>
                                    <td class="text-center">{{$s->Edit}}</td>
                                    <td class="text-center">{{$s->New}}</td>
                                    <td class="text-center">{{$s->Revision}}</td>
                                    <td class="text-center">{{$s->All_Quotes}}</td>
                                    <td class="text-center">{{$s->Edit_Revision_Quotes}}</td>
                                    <td class="text-center">{{$s->ConvertedQuote}}</td>
                                   
                                   
                        
                                </tr>
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