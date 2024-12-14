<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h2>Order Details</h2>
    <p><strong>Option A:</strong></p>
    <ul>
        <li>Height: {{ $emailData['height_A'] }}</li>
        <li>Width: {{ $emailData['width_A'] }}</li>
        <li>Stitches: {{ $emailData['stitches_A'] }}</li>
        <li>Price: ${{ $emailData['price_A'] }}</li>
    </ul>
    <p><strong>Option B:</strong></p>
    <ul>
        <li>Height: {{ $emailData['height_B'] }}</li>
        <li>Width: {{ $emailData['width_B'] }}</li>
        <li>Stitches: {{ $emailData['stitches_B'] }}</li>
        <li>Price: ${{ $emailData['price_B'] }}</li>
    </ul>
    <p><strong>Total: ${{ $emailData['total'] }}</strong></p>
    
    @if($emailData['comment'])
        <p><strong>Comment:</strong> {{ $emailData['comment'] }}</p>
    @endif
</body>
</html>
