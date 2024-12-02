@extends('support.customers.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">All Customers</h6>

                </div>
                
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> ID# </th>
                                <th scope="col"> Customer Nick </th>
                                <th scope="col"> Contact Person </th>
                                <th scope="col"> Registration Date </th>
                                <th scope="col"> Company Name </th>
                                <th scope="col"> Phone </th>
                                <th scope="col"> Email </th>
                                <th scope="col"> Billing </th>
                                <th scope="col"> Ref </th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $c)
                          
                            <tr>
                              
                                <td>{{ $loop->iteration }}</td>
                                <td>ID-{{$c->id}}</td>
                                <td>{{$c->name}}</td>
                                <td>{{$c->contact_name}}</td>
                                <td>{{$c->created_at}}</td>
                                <td>{{$c->company_name}}</td>
                                <td>{{$c->phone}}</td>
                                <td>{{$c->email}}</td>
                                <td>cc</td>
                                <td>{{$c->reference}}</td>
                             
                                <td class="d-flex justify-content-start">
                                    <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('supportcustomers.show', ['supportcustomer' => $c->id]) }}">Details</a>

                                        {{-- <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('supportcustomers.dashboard', ['id' => $c->id]) }}"  target="_blank">records</a> --}}

                                        <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('customer.dashboard', ['id' => $c->id]) }}"  target="_blank">records</a>

                                        <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('supportcustomers.addinvoice', ['id' => $c->id]) }}"  target="_blank">Invoice</a>
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