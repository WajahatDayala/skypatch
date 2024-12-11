@extends('sales.customers.invoice.base')

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

                <form action="{{ route('supportcustomers.storeinvoice') }}" method="POST">
    @csrf
    <div class="col-md-4">
        <div class="form-group">
            <span class="d-flex flex-column align-items-start">Invoice No#</span>
            <input type="text" class="form-control" name="invoice-no" value="{{ $nextInvoiceNumber }}" readonly />
        </div>
        <input name="customerId" hidden type="text" value="{{$customer->id}}">
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
                                <input type="number" name="price[]" readonly class="form-control price-input" data-row="{{ $loop->iteration }}" value="{{$o->total}}" />
                                <input type="text" hidden name="relased_date[]" value="{{$o->releasedDate}}">
                            </td>
                        </tr>
                    @endforeach
                    @foreach($vectorOrders as $v)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_vector_orders[]" value="{{ $v->vector_id }}" class="check-box" data-row="{{ $loop->iteration }}_vector">
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td><input type="text" name="designNumber[]" class="form-control" value="{{ $v->design_number }}" readonly /></td>
                            <td><input type="text" name="designName[]" class="form-control" value="{{ $v->design_name }}" readonly /></td>
                            <td class="col-sm-4 text-center">
                                <input type="number" name="vector_price[]" class="form-control price-input" readonly  data-row="{{ $loop->iteration }}_vector" value="{{$v->total}}" />
                                <input type="text" hidden name="v_relased_date[]" value="{{$v->releasedDate}}">
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
                    <button type="submit" class="btn btn-primary" id="submit-btn" >Submit</button>
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
document.querySelectorAll('.check-box').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        let rowIndex = checkbox.getAttribute('data-row'); // Get the row index
        let priceInput = document.querySelector(`.price-input[data-row="${rowIndex}"]`);

        if (priceInput) {  // Check if priceInput exists
            if (checkbox.checked) {
                priceInput.disabled = false; // Enable the price input when checked
            } else {
                priceInput.disabled = true; // Disable the price input when unchecked
               // priceInput.value = ''; // Optionally clear the value when unchecked
            }
        } else {
            console.error(`Price input for row ${rowIndex} not found`);
        }

        updateTotal();        // Update the total price after checking/unchecking
    });
});

// Update total whenever price inputs change
document.querySelectorAll('.price-input').forEach(function(input) {
    input.addEventListener('input', function() {
        updateTotal(); // Update the total when the value of price input changes
    });
});

function updateTotal() {
    let totalPrice = 0;

    // Iterate through all checkboxes to calculate the total price of selected items
    document.querySelectorAll('.check-box').forEach(function(checkbox) {
        if (checkbox.checked) {  // Only consider checked checkboxes
            let rowIndex = checkbox.getAttribute('data-row');
            let priceInput = document.querySelector(`.price-input[data-row="${rowIndex}"]`);

            if (priceInput && priceInput.value) {  // Make sure there's a price input and it's not empty
                totalPrice += parseFloat(priceInput.value);  // Add the price value
            }
        }
    });

    // Update the total in the footer cell with id="total-price"
    document.getElementById('total-price').innerText = totalPrice.toFixed(2);
}

// Add hidden inputs for prices when submitting the form
document.querySelector('form').addEventListener('submit', function(e) {
    const checkedCheckboxes = document.querySelectorAll('.check-box:checked');
    
    // Ensure hidden inputs are added for each selected order with a valid price
    checkedCheckboxes.forEach(function(checkbox) {
        const rowIndex = checkbox.getAttribute('data-row');
        const priceInput = document.querySelector(`.price-input[data-row="${rowIndex}"]`);
        
        if (priceInput && priceInput.value && !priceInput.disabled) {
            // Create a hidden input for each price (only if the price is not empty and the input is enabled)
            const hiddenPriceInput = document.createElement('input');
           // hiddenPriceInput.type = 'hidden';
            hiddenPriceInput.name = 'price[]'; // Ensure these are sent with the form
            hiddenPriceInput.value = priceInput.value;
            e.target.appendChild(hiddenPriceInput); // Append the hidden input to the form
        }
    });
});

</script>



@endsection
