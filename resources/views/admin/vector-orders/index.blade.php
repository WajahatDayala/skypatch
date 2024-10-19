@extends('admin.vector-orders.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">All Vectors</h6>

                </div>
              
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> VO# </th>
                                <th scope="col"> Design Name </th>
                                <th scope="col"> Rcv'd Date </th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $q)
                            @if($q->super_urgent ==1)
                            <tr class="bg-danger bg-gradient text-white">
                                @endif
                                <td>{{ $loop->iteration }}</td>
                                <td>VO-{{$q->order_id}}</td>
                               
                                
                                <td>{{$q->design_name}} {{$q->description}}
                                </td>
                              
                                <td>{{$q->created_at}}</td>
                                <td>
                                <span class="btn btn-sm {{ $q->status_id == 1 ? 'btn-success' : 'btn-secondary' }} rounded-pill m-2" href="">{{$q->status}}</span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('vector-orders.show',['vector_order'=>$q->order_id]) }}">Details</a>
                                </td>
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