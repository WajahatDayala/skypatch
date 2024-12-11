@extends('admin.customers.customer-dashboard-invoice.allorders.base')
@section('action-content')
    <!-- Blank Start -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <!-- Recent Sales Start -->
            <div class="container-fluid">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h6 class="mb-0 m-2">All Orders</h6>
                        <a href="{{ url('customers/' . $user->id . '/invoices') }}" class="btn btn-dark ms-1">All Invoices</a>
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
                                    <th scope="col"> OR # </th>
                                    <th scope="col"> Desing Name </th>
                                    <th scope="col"> Received Date </th>
                                    <th scope="col"> Released Date </th>
                                    <th scope="col"> Price </th>
                                    <th scope="col"> Status </th>
                                    <th scope="col"> Invoice </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalAmount = 0; // Initialize total amount
                                    $iterationCount = 1; // Initialize iteration counter
                                @endphp

                                @foreach ($orderInvoice as $o)
                                    <!-- Check for Order (order_id is not null) -->
                                    @if ($o->orderId)
                                        <tr>
                                            <td>{{ $iterationCount }}</td>
                                            <td>OR-{{ $o->orderId }}</td>
                                            <td>{{ $o->orderDesign }}</td> <!-- Display name from orders -->

                                            <td>{{ $o->ordersCreatedAt }}</td>
                                            <td>{{ $o->released_date }}</td>
                                            <td>{{ $o->price }}</td>
                                            <td>{{ $o->paid_on == 1 ? 'Paid' : 'Payable' }}</td>
                                            <td>
                                                @if ($o->paid_on == 1)
                                                    <a class="btn btn-sm btn-dark rounded-pill "
                                                        href="{{ route('customer.download', $o->invoiceId) }}">{{ $o->invoice_number }}</a>
                                                @endif

                                            </td>
                                        </tr>
                                        @php
                                       
                                        $iterationCount++;  // Increment iteration counter
                                    @endphp
                                    @endif
                                    <!-- Check for Vector Order (vector_id is not null) -->
                                    @if ($o->vectorId)
                                        <tr>
                                            <td>{{ $iterationCount }}</td>
                                            <td>VO-{{ $o->vectorId }}</td>
                                            <td>{{ $o->vectorDesign }}</td> <!-- Display name from vector_orders -->
                                         
                                            <td>{{ $o->vectorCreatedAt }}</td>
                                            <td>{{ $o->released_date }}</td>
                                            <td>{{ $o->price }}</td>
                                            <td>{{ $o->paid_on == 1 ? 'Paid' : 'Payable' }}</td>
                                            <td>
                                                @if ($o->paid_on == 1)
                                                    <a class="btn btn-sm btn-dark rounded-pill "
                                                        href="{{ route('customer.download', $o->invoiceId) }}">{{ $o->invoice_number }}</a>
                                                @endif

                                            </td>
                                        </tr>
                                        @php
                                       
                                        $iterationCount++;  // Increment iteration counter
                                         @endphp
                                    @endif
                                 
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
                const invoiceId = this.getAttribute('data-file-id'); // Get the invoice ID
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
                            const toggleButton = document.querySelector(
                                `${modalId} #toggleStatusButton`);

                            // Populate modal with invoice details
                            if (modalDetails) {
                                modalDetails.textContent = `${invoice.invoice_email} `;
                                // modalDetails.textContent = `${invoice.invoice_email} - Invoice ID: ${invoice.invoice_number}`;
                            }

                            const statusText = invoice.invoice_status === 1 ?
                                'This is a Paid Invoice' :
                                'This is a Payable Invoice';
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            status: newStatus
                        }) // Only sending status to update
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Update the modal with the new status
                            const statusText = newStatus === 1 ? 'This is a Paid Invoice' :
                                'This is a Payable Invoice.';
                            const modalStatus = document.querySelector(
                                `#orderStatusModal-${invoiceId} #invoiceStatus`);
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
