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


                                             
                                        <td id="invoice-status-{{ $i->invoiceId }}">
                                            @if ($i->invoice_status === 1)
                                                <span>Paid</span>
                                            @elseif($i->invoice_status === 0)
                                                <span>Payable</span>
                                            @else
                                                <span>N/A</span>
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
                            <a class="btn btn-sm btn-primary rounded-pill" id="downloadInvoice" href="#"> Download</a>
                            <button type="button" class="btn btn-sm btn-dark rounded-pill" id="emailInvoiceButton" data-invoice-id="{{ $i->invoiceId }}">
                                {{-- <i class="fas fa-envelope"></i>  --}}
                                Email
                            </button>
                            <a class="btn btn-sm btn-success rounded-pill" href="#" type="button" id="followUp" data-invoice-id="{{ $i->invoiceId }}">
                                <i class="fas fa-envelope"></i> Follow Up
                            </a>
                            
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



    </script>



<!--send invoice -->
<script>
    // Use event delegation to handle clicks on dynamically created buttons
    document.addEventListener('DOMContentLoaded', function () {
        // Delegate the event listener to the parent container (like the body)
        document.body.addEventListener('click', function(event) {
            // Check if the clicked element is the 'emailInvoiceButton'
            if (event.target && event.target.id === 'emailInvoiceButton') {
                const invoiceId = event.target.getAttribute('data-invoice-id');  // Get the invoice ID
    
                // Send the request to send the invoice email
                fetch(`/admin/invoice/${invoiceId}/send-invoice-email`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Invoice email sent successfully!');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to send invoice email.');
                });
            }
        });
    });
    
  
    </script>
    
    <!-- follow up -->

    <!-- Follow Up Button (does not modify invoice status) -->

    <!--  end follow up -->

    <script>
        // Follow Up Button - This does NOT modify invoice status
document.querySelectorAll('#followUp').forEach(button => {
    button.addEventListener('click', function(event) {
        // Prevent the default action (navigate link)
        event.preventDefault();

        const invoiceId = this.getAttribute('data-invoice-id');  // Get the invoice ID

        // Send the request to send the follow-up email
        fetch(`/admin/invoice/${invoiceId}/send-followup`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())  // Parse the response
        .then(data => {
            if (data.status === 'success') {
                alert('Follow-up email sent successfully!');  // Show success message
            } else {
                alert('Failed to send follow-up: ' + data.message); // Show error message
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to send follow-up email.');
        });
    });
});



// Mark as Paid Button - This handles only the status change (Not Follow-up)
document.querySelectorAll('#toggleStatusButton').forEach(button => {
    button.addEventListener('click', function() {
        const invoiceId = this.getAttribute('data-invoice-id');  // Get the invoice ID
        const currentStatus = parseInt(this.getAttribute('data-status')); // Get the current status (1 = Paid, 0 = Unpaid)
        const newStatus = currentStatus === 1 ? 0 : 1; // Toggle the status: if Paid (1), change to Unpaid (0), and vice versa
        const tdId = `invoice-status-${invoiceId}`; // Get the corresponding <td> id dynamically

        // Send the new status to the server via AJAX
        fetch(`/admin/invoice/${invoiceId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ status: newStatus }) // Sending status to the server to update
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update the modal with the new status
                const statusText = newStatus === 1 ? 'This is a Paid Invoice' : 'This is a Payable Invoice';
                const modalStatus = document.querySelector(`#orderStatusModal-${invoiceId} #invoiceStatus`);
                if (modalStatus) {
                    modalStatus.textContent = statusText;
                }

                // Also update the status in the corresponding <td> (in the table)
                const statusTd = document.getElementById(tdId); // Get the corresponding <td>
                if (statusTd) {
                    const statusSpan = statusTd.querySelector('span');
                    if (statusSpan) {
                        statusSpan.textContent = newStatus === 1 ? 'Paid' : 'Payable';

                        // Change color of text based on the status
                        if (newStatus === 1) {
                            statusSpan.style.color = 'green';  // Paid status color (green)
                        } else {
                            statusSpan.style.color = 'red';    // Payable status color (red)
                        }
                    }
                }

                // Update the modal toggle button text based on the new status
                const toggleButton = document.querySelector(`#orderStatusModal-${invoiceId} #toggleStatusButton`);
                if (toggleButton) {
                    toggleButton.textContent = newStatus === 1 ? 'Mark as Payable' : 'Mark as Paid';
                    toggleButton.setAttribute('data-status', newStatus); // Update the data-status attribute for future toggling
                }

                // Update the "Payable"/"Paid" button text inside the table
                const tableButton = document.querySelector(`#invoice-status-${invoiceId} .btn-success`);
                if (tableButton) {
                    tableButton.textContent = newStatus === 1 ? 'Mark as Unpaid' : 'Mark as Paid';
                    tableButton.setAttribute('data-status', newStatus); // Update the button's data-status for future toggling
                }
            } else {
                console.error('Failed to update invoice status.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Optionally, alert the user about the error
        });
    });
});
    </script>
    
@endsection
