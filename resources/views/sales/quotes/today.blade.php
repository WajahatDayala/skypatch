@extends('sales.quotes.base')
@section('action-content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">Today Quotes</h6>

                </div>
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> QT# </th>
                                <th scope="col"> Rcv'd Date </th>
                                <th scope="col"> Sent Date </th>
                                <th scope="col"> Design Name </th>
                                <th scope="col"> Customer Nick </th>
                                <th scope="col"> Designer </th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotes as $q)
                            @if($q->super_urgent ==1)
                            <tr class="bg-danger bg-gradient text-white">
                                @endif
                                <td>{{ $loop->iteration }}</td>
                                <td>QT-{{$q->order_id}}</td>
                                <td>{{$q->createdAt}}</td>
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
                                    @if($q->designer_name)
                                    {{ $q->designer_name }}
                                    @else
                                    <strong class="text-danger">Not Assigned</strong>
                                    @endif

                                </td>
                                <td> <span
                                        class="btn btn-sm {{ $q->status == 1 ? 'btn-success' : 'btn-secondary' }} rounded-pill m-2"
                                        href="">{{$q->status}}</span></td>
                                <td>
                                   
                                    <a class="btn btn-sm btn-primary rounded-pill m-2"
                                    href="{{ route('sales-allquotes.show', ['sales_allquote' => $q->order_id]) }}">Details</a>
                                    {{-- <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn" data-file-id="{{ $q->order_id }}" data-bs-toggle="modal" data-bs-target="#deleteFileModal">Delete</button> --}}
                                </td>
                            </tr>
                            @endforeach




<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFileModalLabel">Delete Quote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this file?</p>
                {{-- <p id="file_ids"></p> <!-- This will display the Quote ID dynamically --> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteFileForm" method="POST" action="{{ route('supportquotes.deleteQuote') }}">
                    @csrf
                    <span id="file_ids"></span>
                    <input type="text" hidden id="file_id" name="quote_id" value="">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    </div>
</div>
<!-- Blank End -->



<!-- JavaScript to handle the modal -->
<script>
    const deleteFileButtons = document.querySelectorAll('.delete-file-btn');
    const fileIdInput = document.getElementById('file_id');
  //  const fileIdText = document.getElementById('file_ids'); // This will hold the file ID for viewing in the modal
    const modalTitle = document.getElementById('deleteFileModalLabel'); // Modal title to dynamically update



    deleteFileButtons.forEach(button => {
        button.addEventListener('click', function() {
            const fileId = this.getAttribute('data-file-id');
            fileIdInput.value = fileId; // Set the file ID in the hidden input
            //fileIdText.textContent = `QT-: ${fileId}`; // Set the text for Quote ID display in modal
            modalTitle.textContent = `Delete this QT-${fileId}`; // Update the modal title to include Quote ID
        });
    });
</script>

@endsection