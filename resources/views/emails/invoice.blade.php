<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Email</title>
</head>
<body>
    <h2>Invoice from {{ config('app.name') }}</h2>
    <p>Dear {{ $invoice->customer_name }},</p>
    <p>Thank you for your purchase. Please find your invoice attached.</p>
    <p>If you have any questions, feel free to contact us.</p>
    <p>Best Regards,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
