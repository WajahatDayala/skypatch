@extends('support.customers.invoice.base')
@section('action-content')
    <!-- Blank Start -->
<meta name="csrf-token" content="{{ csrf_token() }}">



    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <!-- Recent Sales Start -->
            <div class="container-fluid">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                        <h6 class="mb-0">All Invoices</h6>

                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 "></div>
                        <div class="col-lg-4"><a style="color:#fff; margin-left:70%;"
                                class="btn btn-rounded btn-primary mb-3" href="{{ url('customer/orders/create') }}"><i
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
                                    <th scope="col"> Invoice# </th>
                                    <th scope="col"> Generated On </th>
                                    <th scope="col"> Paid On </th>
                                    <th scope="col"> Amount </th>
                                    <th scope="col"> Status </th>
                                    <th scope="col"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $i)
                                    <tr class="">

                                        <td>{{ $loop->iteration }}</td>


                                        <td>{{ $i->invoiceNumber }}</td>




                                        <td>{{ $i->createdAt }}
                                        </td>

                                        <td>{{ $i->updatedAt == null? '-' :$i->updatedAt }}</td>
                                        <td>{{ $i->total_amount ? $i->total_amount : 0 }}</td>


                                        <td>
                                            @if ($i->invoice_status === 1)
                                                <!-- Assuming 1 means Paid -->
                                                <span>Paid</span>
                                            @elseif($i->invoice_status === 0)
                                                <!-- Assuming 0 means Unpaid -->
                                                <span>Payable</span>
                                            @else
                                                <span>N/A</span>
                                                <!-- In case neither paymentStatus nor vectorPaymentStatus are available -->
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-dark rounded-pill "
                                                href="{{ route('invoice.download', $i->invoiceId) }}">Download</a>
                                            
                                                <button  type="button" class="btn btn-sm btn-danger rounded-pill"
                                                data-file-id="{{ $i->invoiceId }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#orderStatusModal-{{ $i->invoiceId }}">
                                            Payable
                                        </button>
                                        <div class="modal fade" id="orderStatusModal-{{ $i->invoiceId }}" tabindex="-1" role="dialog"
                                            aria-labelledby="orderStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderStatusModalLabel">Invoice Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="orderStatusForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <p id="invoiceDetails"></p>
                    </div>
                    <p class="text-center"><strong id="invoiceStatus"></strong></p>
                    <div class="form-group">
                        <div class="text-center">
                            <a class="btn btn-sm btn-primary rounded-pill" id="downloadInvoice" href="#">Download</a>
                            <a class="btn btn-sm btn-dark rounded-pill" href=""><i class="fas fa-email"></i> Email</a>
                            <a class="btn btn-sm btn-success rounded-pill" href=""><i class="fas fa-email"></i> Follow Up</a>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              
                    <button type="button" class="btn btn-success" id="toggleStatusButton">Mark as {{$i->invoice_status ==1? 'unPaid':'Paid'}}</button>
                 
                    
                    
                </div>
            </form>
        </div>
    </div>
</div>

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
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function() {
        const invoiceId = this.getAttribute('data-file-id');  // Get the invoice ID
        const modalId = `#orderStatusModal-${invoiceId}`; // Generate the modal ID dynamically

        // Perform AJAX request to fetch invoice details
        fetch(`/admin/invoice/${invoiceId}/fetch-details`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const invoice = data.invoice;

                    // Select the modal elements dynamically based on the modal ID
                    const modalDetails = document.querySelector(`${modalId} #invoiceDetails`);
                    const modalStatus = document.querySelector(`${modalId} #invoiceStatus`);
                    const modalDownload = document.querySelector(`${modalId} #downloadInvoice`);
                    const toggleButton = document.querySelector(`${modalId} #toggleStatusButton`);

                    // Populate modal with invoice details
                    if (modalDetails) {
                        modalDetails.textContent = `${invoice.invoice_email} `;
                       // modalDetails.textContent = `${invoice.invoice_email} - Invoice ID: ${invoice.invoice_number}`;
                    }

                    const statusText = invoice.invoice_status === 1 
                        ? 'This is a Paid Invoice' 
                        : 'This is a Payable Invoice';
                    if (modalStatus) {
                        modalStatus.textContent = statusText;
                    }

                    // Set the download link
                    if (modalDownload) {
                        modalDownload.href = `/admin/invoice/${invoice.invoiceId}/download`;
                    }

                    // Save the invoice ID and status in the modal for later use
                    if (toggleButton) {
                        toggleButton.setAttribute('data-invoice-id', invoice.invoiceId);
                        toggleButton.setAttribute('data-status', invoice.invoice_status);
                    }
                } else {
                    alert('Failed to load invoice details.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while loading invoice details.');
            });
    });
});

// Handle the toggle of the invoice status (paid/unpaid)
document.querySelectorAll('.btn-success').forEach(button => {
    button.addEventListener('click', function() {
        const invoiceId = this.getAttribute('data-invoice-id');
        const currentStatus = parseInt(this.getAttribute('data-status'));
        const newStatus = currentStatus === 1 ? 0 : 1; // Toggle between 1 (paid) and 0 (unpaid)

        // Send the new status to the server via AJAX
        fetch(`/admin/invoice/${invoiceId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ status: newStatus }) // Only sending status to update
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update the modal with the new status
                const statusText = newStatus === 1 ? 'This is a Paid Invoice' : 'This is a Payable Invoice.';
                const modalStatus = document.querySelector(`#orderStatusModal-${invoiceId} #invoiceStatus`);
                if (modalStatus) {
                    modalStatus.textContent = statusText;
                }

                // Optionally, you can reload the invoice list or update the table row
               // alert('Invoice status updated successfully!');
            } else {
               // alert('Failed to update invoice status.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            //alert('An error occurred while updating the invoice status.');
        });
    });
});

    </script>
@endsection
