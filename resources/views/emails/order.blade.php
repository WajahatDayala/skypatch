<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        /* Resetting Styles for Email */
        body, table, td, a {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        .header {
            background-color: #0c1337;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
        }

        /* Wrapper to ensure full width */
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f4;
            padding: 20px;
        }

        /* Main Email Container (Controls width of content) */
        .email-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .card-body {
            font-size: 16px;
            color: #333;
            background-color: #fff;
        }

        .footer {
            background-color: #0c1337;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        /* Quote Details Table */
        .quote-details-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .quote-details-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .quote-details-table th {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
            background-color: #f4f4f4;
        }

        .quote-total {
            font-weight: bold;
            text-align: right;
            padding-top: 15px;
        }

        .attachment-mention {
            font-style: italic;
            font-size: 14px;
            color: #555;
            margin-top: 20px;
            text-align: center;
        }

        /* Responsive Styles for Mobile */
        @media only screen and (max-width: 600px) {
            .quote-details-table td, .quote-details-table th {
                display: block;
                width: 100%;
                box-sizing: border-box;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>SKYPATCHES & Digitizers</h1>
        </div>

        <table class="email-container" role="presentation">
            <tr>
                <td>
                    <!-- Order Details Section -->
                    <div class="card-header">
                        <h2>Job Information</h2>
                    </div>

                    <!-- Order Details Table for Option A and Option B -->
                    <table class="quote-details-table">
                        <thead>
                            <tr>
                                <th>Specification</th>
                                <th>Option A</th>
                                <th>Option B</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Height</strong></td>
                                <td>{{ $emailData['height_A'] }}</td>
                                <td>{{ $emailData['height_B'] }}</td>
                                <td rowspan="4" class="quote-total">${{ $emailData['total'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Width</strong></td>
                                <td>{{ $emailData['width_A'] }}</td>
                                <td>{{ $emailData['width_B'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stitches</strong></td>
                                <td>{{ $emailData['stitches_A'] }}</td>
                                <td>{{ $emailData['stitches_B'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Price</strong></td>
                                <td>${{ $emailData['price_A'] }}</td>
                                <td>${{ $emailData['price_B'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                                       <!-- Comment Section (Centered) -->
                                       @if($emailData['comment'])
                                       <div style="text-align: center; padding-top: 20px;">
                                           <p><strong>Comment </strong><br> {{ $emailData['comment'] }}</p>
                                       </div>
                                   @endif

                    <!-- Mention files (Centered) -->
                    <div class="attachment-mention">
                        <p><strong>Note:</strong> The details of Option A and Option B are provided above. Please find the attached files with this order. Let us know if you have any questions or require further information.</p>
                    </div>

                    <br>

                    <!-- Footer Information -->
                    <p style="text-align: center;">Best Regards,<br>
                    Team SKYPATCHES & Digitizers<br>
                    Email: <a href="mailto:accounts@skypatches.com">accounts@skypatches.com</a><br>
                    URL: <a href="http://www.skypatches.com">www.skypatches.com</a></p>
                </td>
            </tr>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; 2024 SKYPATCHES & Digitizers. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
