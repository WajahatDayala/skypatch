<!-- resources/views/admin/invoices/invoice_pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="invoice-header">
        <h2>Invoice #{{ $invoice->id }}</h2>
        <p>Generated on: {{ $invoice->created_at->format('Y-m-d') }}</p>
    </div>

    <div class="invoice-details">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through invoice items -->
             
            </tbody>
        </table>
    </div>

    <div class="total-amount">
        
    </div>

</body>
</html>
