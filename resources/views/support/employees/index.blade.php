@extends('support.customers.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">Employees</h6>

                </div>
                 <div class="row">
                                 <div class="col-lg-4"></div>
                                 <div class="col-lg-4 "></div>
                                <div class="col-lg-4 col-xs-offset-right-12"><a style="margin-left: 70%; color:#fff;" class="btn btn-rounded btn-primary mb-3" href="{{url('admin/employees/create')}}"><i class="fa fa-plus">Add New</i></a></div>
                                </div>
                
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> Name </th>
                                <th scope="col"> Username </th>
                                <th scope="col"> Role </th>
                             
                                <!-- <th scope="col"> Action </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee as $e)
                          
                            <tr>
                              
                                <td>{{ $loop->iteration }}</td>
                             
                                <td>{{$e->employeeName}}</td>
                                <td>{{$e->username}}</td>
                                <td>{{$e->roles}}</td>
                              
                                <!-- <td>
                                    <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('employees.show', ['employee' => $e->id]) }}">Details</a>

                                        <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="">records</a>
                                </td> -->
                            </tr>
                            @endforeach






                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    </div>
</div>
<!-- Blank End -->


@endsection