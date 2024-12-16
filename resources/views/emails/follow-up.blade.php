<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Follow-up</title>
</head>
<body>
    <h2>Follow-up on Your Invoice #{{ $invoice->invoice_number }}</h2>
    <p>Dear {{ $invoiceDetail->customer_name }},</p>
    
    @if ($invoice->invoice_status == 0)
        <p>This is a friendly reminder that your invoice <strong>#{{ $invoice->invoice_number }}</strong> for the amount of <strong>${{ $invoiceDetail->price }}</strong> is still <strong>Payable</strong>.</p>
        <p>We kindly request that you make the payment as soon as possible. If you have any questions or concerns, please do not hesitate to contact us.</p>
    @elseif ($invoice->invoice_status == 1)
        <p>Thank you for your payment! Your invoice <strong>#{{ $invoice->invoice_number }}</strong> for the amount of <strong>${{ $invoiceDetail->price }}</strong> has been <strong>Paid</strong>.</p>
        <p>If you have any further questions, feel free to reach out to us. We appreciate your prompt payment!</p>
    @else
        <p>There seems to be an issue with the invoice status. Please contact us for further clarification.</p>
    @endif
    
    <p>Best regards,</p>
    {{-- <p>{{ config('app.name') }}</p> --}}
    <p>SKYPATCHES & DIGITIZERS</p>
</body>
</html>
