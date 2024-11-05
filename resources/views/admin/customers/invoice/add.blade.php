@extends('admin.customers.invoice.base')

@section('action-content')
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">Add Invoice</h6>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customer.storeinvoice') }}" method="POST">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-group">
                            <span class="d-flex flex-column align-items-start">Invoice No#</span>
                            <input type="text" class="form-control" name="invoice-no" value="{{ $nextInvoiceNumber }}" readonly />
                        </div>
                    </div>

                    <div class="row">
                        <h1>Order Information</h1>
                        <div class="table-responsive">
                            <table id="orders-table" class="table mt-4 text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col"> Sr# </th>
                                        <th scope="col"> Design# </th>
                                        <th scope="col"> Design Name </th>
                                        <th scope="col"> Price </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $o)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selected_orders[]" value="{{ $o->order_id }}" class="check-box" data-row="{{ $loop->iteration }}">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><input type="text" name="designNumber[]" class="form-control" value="{{ $o->design_number }}" readonly /></td>
                                            <td><input type="text" name="designName[]" class="form-control" value="{{ $o->design_name }}" readonly /></td>
                                            <td class="col-sm-4 text-center">
                                                <input type="number" name="price[]" class="form-control price-input" style="display: none;" data-row="{{ $loop->iteration }}" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">Total</td>
                                        <td class="text-center" id="total-price">0</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="row mt-4">
                                <div class="d-flex flex-column align-items-end">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" disabled>Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let totalPrice = 0;

        // Function to update the total price
        function updateTotal() {
            totalPrice = 0;
            document.querySelectorAll('.price-input').forEach(function(input) {
                if (input.style.display !== 'none' && input.value) {
                    totalPrice += parseFloat(input.value);
                }
            });
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        }

        // Enable/Disable submit button based on checkbox selection and price input
        function toggleSubmitButton() {
            const submitButton = document.getElementById('submit-btn');
            const anyChecked = document.querySelectorAll('.check-box:checked').length > 0;
            const allPricesFilled = Array.from(document.querySelectorAll('.price-input')).every(function(input) {
                return input.style.display === 'none' || input.value; // Only check if the price field is shown and filled
            });

            submitButton.disabled = !(anyChecked && allPricesFilled);  // Enable submit only if both conditions are true
        }

        // Handle checkbox change
        document.querySelectorAll('.check-box').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let rowIndex = checkbox.getAttribute('data-row');  // Get the row index
                let priceInput = document.querySelector(`.price-input[data-row="${rowIndex}"]`);

                if (checkbox.checked) {
                    priceInput.style.display = 'block';  // Show the price input field
                } else {
                    priceInput.style.display = 'none';  // Hide the price input field
                    priceInput.value = '';              // Reset the price value
                }

                updateTotal();  // Update the total price after checking/unchecking
                toggleSubmitButton(); // Check if submit button should be enabled
            });
        });

        // Handle price input change
        document.querySelectorAll('.price-input').forEach(function(input) {
            input.addEventListener('input', function() {
                updateTotal();  // Recalculate the total price
                toggleSubmitButton(); // Check if the price is valid and submit button should be enabled
            });
        });

        toggleSubmitButton();  // Initialize the button state on page load
    });
</script>
@endsection
