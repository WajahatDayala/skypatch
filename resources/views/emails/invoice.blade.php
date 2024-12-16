<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow Up</title>
    <style>
        /* Resetting Styles for Email */
        body, table, td, a {
            font-family: Arial, sans-serif;
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

        /* Responsive Styles for Mobile */
        @media only screen and (max-width: 600px) {
            .col-6 {
                width: 100% !important;
            }

            .card-wide {
                max-width: 100% !important;
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
                    <!-- Card Section -->

                    <b>Dear {{ $invoice->customer_name }},</b>

                    <!-- Conditional Message Based on Invoice Status -->
                    @if ($invoice->invoice_status == 0)
                        <p>This is a friendly reminder that your invoice <strong>#{{ $invoice->invoice_number }}</strong> is still <strong>Payable</strong>.</p>
                        <p>Please find your invoice attached. We kindly request that you make the payment as soon as possible.</p>
                    @elseif ($invoice->invoice_status == 1)
                        <p>Thank you for your payment! Your invoice <strong>#{{ $invoice->invoice_number }}</strong> has been <strong>Paid</strong>.</p>
                        <p>We have attached your paid invoice for your records. If you have any further questions, feel free to contact us.</p>
                    @else
                        <p>There seems to be an issue with the invoice status. Please contact us for further clarification.</p>
                    @endif

                    <br>
                    <p>Best Regards,<br>
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
        <p>Stay connected with us for more updates!</p>
    </div>
</body>
</html>
