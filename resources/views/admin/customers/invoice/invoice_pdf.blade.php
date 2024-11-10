<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }
        p { margin: 0; padding: 0; }
        .ft10 { font-size: 27px; font-family: 'Montserrat', sans-serif; color: #000000; }
        .ft11 { font-size: 14px; font-family: 'Montserrat', sans-serif; color: #000000; }
        .ft12 { font-size: 40px; font-family: 'Montserrat', sans-serif; color: #000000; }
        .ft13 { font-size: 14px; font-family: 'Montserrat', sans-serif; color: #0462c1; }
        .ft14 { font-size: 16px; font-family: 'Montserrat', sans-serif; color: #000000; }
        .ft15 { font-size: 16px; font-family: 'Montserrat', sans-serif; color: #0462c1; }
        .ft16 { font-size: 14px; line-height: 22px; font-family: 'Montserrat', sans-serif; color: #000000; }
        .ft17 { font-size: 16px; line-height: 21px; font-family: 'Montserrat', sans-serif; color: #000000; }

        /* General Page Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Make sure the body takes up at least 100% of the viewport height */
        }

        /* Content Area to Push Footer to Bottom */
        .content {
            flex: 1; /* Allow the content to take available space */
            padding-bottom: 20px; /* Add some padding at the bottom of the content */
        }

        /* Header Box Styling */
        .header-box {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            border: 1px solid #000;
            box-sizing: border-box;
            height: 180px;
            margin-bottom: 40px;
            align-items: center;
        }

        .title-left {
            font-size: 27px;
            margin-left: 20px;
            line-height: 100px;
        }

        .invoice-box {
          

            font-size: 40px;
            text-align: right;
            padding-right: 10px;
          
            font-family: 'Montserrat', sans-serif;
          
        }

        /* Invoice Details Box */
.invoice-details {
    display: flex;
    justify-content: space-between;  /* Distribute space between invoice number and date */
    padding: 0 20px;  /* Padding for spacing on the left and right */
    box-sizing: border-box;
    margin-top: 40px;
}

.row {
    display: inline-block;
    /* No need for specific width here */
}

/* Optional: Styling for the invoice number and date */
.invoice-number {
    text-align: left;
    font-size: 18px;
}

.invoice-date {
    text-align: right;
    font-size: 18px;
}
        /* Customer Information Box */
        .customer-box {
            width: 100%;
            margin-top: 20px;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .customer-info {
            width: 50%;
            padding-right: 20px;
        }

        /* Order Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-sizing: border-box;
            table-layout: fixed; /* Ensures equal width columns */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
            font-size: 13px;
        }

        th {
            background-color: #f2f2f2;
            font-size: 11px;
        }

        /* Column widths */
        th:nth-child(1), td:nth-child(1) { width: 5%; }
        th:nth-child(2), td:nth-child(2) { width: 15%; }
        th:nth-child(3), td:nth-child(3) { width: 25%; }
        th:nth-child(4), td:nth-child(4) { width: 15%; }
        th:nth-child(5), td:nth-child(5) { width: 15%; }
        th:nth-child(6), td:nth-child(6) { width: 15%; }
        th:nth-child(7), td:nth-child(7) { width: 15%; }

        .total {
            font-weight: bold;
            text-align: right;
        }

        /* Footer Box Styling */
        .footer-box {
            width: 100%;
            border: 1px solid #000;
            text-align: center;
            margin-top: 20px; /* Add margin to separate from content */
            box-sizing: border-box;
        }

        /* Page Break and Flexbox Handling */
        .page-break {
            page-break-before: always;
        }
        .img-logo {
            height: 80px;
            width: auto;
        }
       
    </style>
  
</head>
<body>

    <!-- Header Box with SkyPatches and Invoice -->
    <div class="header-box">
       
        <div class="title-left ft10">
             
  <img class="img-logo" src="data:image/png;base64,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"  alt="Logo">           
        </div>
        <div class="invoice-box ft12">Invoice</div> 
   
</div>
    <!-- Invoice Details (Invoice # and Date) -->
    <div class="invoice-details">
       
        <div class="invoice-number"><p>Invoice #: {{ $invoice->invoice_number }}</p></div>
        <div class="invoice-date"><p>Date: {{ $invoice->created_at->format('Y-m-d') }}</p></div>
    </div>

    

    <!-- Customer Information Box -->
    <div class="customer-box">
        <div class="customer-info">
            <p class="ft11"><b>Customer’s Information</b></p>
            <p class="ft11">Company: {{$invoice->company_name}}</p>
            <p class="ft11">Name: {{$invoice->name}}</p>
            <p class="ft11">Email: <a href="{{$invoice->invoice_email}}" class="ft13">{{$invoice->invoice_email}}</a></p>
            <p class="ft11">Address: {{$invoice->address}}</p>
        </div>
    </div>

    <!-- Order Information -->
    <p style="margin-top: 70px;" class="ft14"><b><center>Order Information</center> </b></p>

    <!-- Order Table -->
    <div class="content">
        <table class="ft14">
            <thead>
                <tr>
                    <th>S#</th>
                    <th>Design #</th>
                    <th>Design Name</th>
                    <th>Payment Status</th>
                    <th>Received Date</th>
                    <th>Released Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalAmount = 0; // Initialize total amount
                $iterationCount = 1; // Initialize iteration counter
            @endphp
            
            @foreach($orderInvoice as $o)
                <!-- Check for Order (order_id is not null) -->
                @if($o->orderId)
                <tr>
                    <td>{{ $iterationCount }}</td>
                    <td>OR-{{ $o->orderId }}</td>
                    <td>{{ $o->orderDesign }}</td>  <!-- Display name from orders -->
                    <td>{{ $o->orderPaymentStatus == 1 ? 'Paid' : 'UnPaid' }}</td>
                    <td>{{ $o->ordersCreatedAt }}</td>
                    <td>{{ $o->orderSentDate }}</td>
                    <td>{{ $o->price }}</td>
                </tr>
                @php
                    $totalAmount += $o->price;  // Add price to totalAmount
                    $iterationCount++;  // Increment iteration counter
                @endphp
                @endif
            
                <!-- Check for Vector Order (vector_id is not null) -->
                @if($o->vectorId)
                <tr>
                    <td>{{ $iterationCount }}</td>
                    <td>VO-{{ $o->vectorId }}</td>
                    <td>{{ $o->vectorDesign }}</td>  <!-- Display name from vector_orders -->
                    <td>{{ $o->vectorPaymentStatus == 1 ? 'Paid' : 'UnPaid' }}</td>
                    <td>{{ $o->vectorCreatedAt }}</td>
                    <td>{{ $o->vectorSentDate }}</td>
                    <td>{{ $o->price }}</td>
                </tr>
                @php
                    $totalAmount += $o->price;  // Add price to totalAmount
                    $iterationCount++;  // Increment iteration counter
                @endphp
                @endif
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td style="border-left: hidden; border-bottom: hidden;"></td>
                    <td style="border-left: hidden; border-bottom: hidden;"></td>
                    <td style="border-left: hidden; border-bottom: hidden;"></td>
                    <td style="border-left: hidden; border-bottom: hidden;"></td>
                    <td style="border-left: hidden; border-bottom: hidden;"></td>
                    <td>Total</td>
                    <td>{{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Footer Box -->
    <div class="footer-box">
        <p class="ft14"><b>Business Address: 12054 3rd St, NE Blaine, MN 55434</b></p>
        <p class="ft14"><b>Phone: (111) 111-1111 Fax: (111) 111-1111</b></p> 
        <p class="ft14"><b>Email: <a href="mailto:digitize@dd.com" class="ft15">digitize@sad.com</a></b></p> 
    </div>

</body>
</html>
