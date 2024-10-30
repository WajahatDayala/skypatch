@extends('admin.customers.quotes.base')
@section('action-content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">Quotes Record</h6>

                </div>
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> OT# </th>
                                <th scope="col"> Rcv'd Date </th>
                                <th scope="col"> Date Finalized </th>
                                <th scope="col"> Design Name </th>
                                <th scope="col"> Customer Nick </th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Convert </th>
                               
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes as $q)
                            @if($q->super_urgent ==1)
                            <tr class="bg-danger bg-gradient text-white">
                                @endif
                                <td>{{ $loop->iteration }}</td>
                                <td>OT-{{$q->order_id}}</td>
                                <td>{{$q->created_at}}</td>
                                <td>
                                    @if(!$q->date_finalized)
                                    N/A
                                    @endif
                                    {{$q->date_finalized}}
                                </td>
                              
                               
                                <td>
                                
                                {{$q->design_name}} {{$q->description}}

                                </td>
                                
                              
                                <td>{{$q->customer_name}}</td>

                                <td>
                                    <span
                                        class="btn btn-sm {{ $q->status == 1 ? 'btn-success' : 'btn-secondary' }} rounded-pill m-2"
                                        href="">{{$q->status}}</span>
                                </td>
                                <td>

                                    @php
                                    // Check if the current quote has been converted
                                    $isConverted = false;
                                    foreach ($quoteConvertedOrder as $convertOrder) {
                                    if ($q->order_id == $convertOrder->orderQuoteId) {
                                    $isConverted = true;
                                    break; // Exit loop if found
                                    }
                                    }
                                    @endphp

                                    @if($isConverted)
                                    <span class=" m-2">Converted</span>
                                    @else
                                    <button class="btn btn-sm btn-primary rounded-pill m-2"
                                        onclick="convertQuote({{ $q->order_id }})">
                                        Convert
                                    </button>
                                    @endif



                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('customer.show-quote', ['id' => $q->order_id]) }}">Details</a>
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

<script>
function convertQuote(quoteId) {
    $.ajax({
        url: '/customer/convert-quote/' + quoteId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.status === 'converted') {
                // Replace the specific button with the "Converted" text
                $('button[onclick="convertQuote(' + quoteId + ')"]').replaceWith(
                    '<span class="text-success">Converted</span>');
            } else if (response.status === 'exists') {
                alert('This quote has already been converted to an order.');
            } else if (response.status === 'not_found') {
                alert('Quote not found.');
            }
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}
</script>


@endsection