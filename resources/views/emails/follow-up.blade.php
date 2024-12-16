<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Follow-up</title>
</head>
<body>
    <h2>Follow-up on Your Payable Invoice #{{ $invoice->invoice_number }}</h2>
    <p>Dear {{ $invoice->customer_name }},</p>
    <p>This is a friendly reminder that your invoice <strong>#{{ $invoice->invoice_number }}</strong> for the amount of <strong>${{ $invoice->amount }}</strong> is still <strong>Payable</strong>.</p>
    <p>We kindly request that you make the payment as soon as possible. If you have any questions or concerns, please do not hesitate to contact us.</p>
    <p>Best regards,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
