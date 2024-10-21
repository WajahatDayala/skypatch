@extends('admin.orders.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">All Orders</h6>

                </div>
                <!-- <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 "></div>
                    <div class="col-lg-4"><a style="color:#fff; margin-left:70%;"
                            class="btn btn-rounded btn-primary mb-3" href="{{url('customer/orders/create')}}"><i
                                class="fa fa-plus">Add New</i></a></div>
                </div> -->
                <!-- <div class="row d-flex">
                  <div class="col-6">
                    <form action="">
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Show: </label>
                        <div class="w-50">
                          <select class="form-select mb-3" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-6 mb-4 d-flex justify-content-end">
                    <form class="d-flex align-items-center justify-content-end">
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label me-3">Search: </label>
                        <div class="w-75">
                          <input type="text" class="form-control" id="search">
                        </div>
                      </div>
                    </form>
                  </div>
                </div> -->
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> OR# </th>
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
                                <td>OR-{{$q->order_id}}</td>
                               
                                
                                <td>{{$q->design_name}} {{$q->description}} 

                                 
                                </td>
                              
                                <td>{{$q->created_at}}</td>
                                <td>
                                <span class="btn btn-sm {{ $q->status == 1 ? 'btn-success' : 'btn-secondary' }} rounded-pill m-2" href="">{{$q->status}}</span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary rounded-pill m-2"
                            
                                    href="{{ route('allorders.show', ['allorder' => $q->order_id]) }}">Details</a>
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