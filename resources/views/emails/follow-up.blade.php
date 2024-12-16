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

        /* Row/Column Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col {
            padding: 0 10px;
        }

        .col-6 {
            width: 48%;
            box-sizing: border-box;
        }

        .col-12 {
            width: 100%;
            box-sizing: border-box;
        }

        /* Card Style for Content */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            width: 100%;
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

        .card-footer {
            font-size: 14px;
            text-align: center;
            padding-top: 10px;
        }

        /* Button Styling */
        .btn {
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Footer Section */
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

        .footer .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .footer .social-icons img {
            width: 25px;
            height: 25px;
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

                            <b>Dear {{ $invoiceDetail->customer_name }},</b>
                            <p>Pay To: <a href="mailto:accounts@skypatches.com">accounts@skypatches.com</a></p>
                            <p>Services Description: <b>Digitizing</b></p>
                            <p>Amount: <b>${{ $invoiceDetail->price }}</b></p>
                            <br>
                            <!-- Conditional Message Based on Invoice Status -->
                            @if ($invoice->invoice_status == 0)
                                <p>This is a friendly reminder that your invoice <strong>#{{ $invoice->invoice_number }}</strong> for the amount of <strong>${{ $invoiceDetail->price }}</strong> is still <strong>Payable</strong>.</p>
                                <p>We kindly request that you make the payment as soon as possible. If you have any questions or concerns, please do not hesitate to contact us.</p>
                            @elseif ($invoice->invoice_status == 1)
                                <p>Thank you for your payment! Your invoice <strong>#{{ $invoice->invoice_number }}</strong> for the amount of <strong>${{ $invoiceDetail->price }}</strong> has been <strong>Paid</strong>.</p>
                                <p>If you have any further questions, feel free to reach out to us. We appreciate your prompt payment!</p>
                            @else
                                <p>There seems to be an issue with the invoice status. Please contact us for further clarification.</p>
                            @endif
                            <br>
                            <p>Team SKYPATCHES & Digitizers<br>
                               Tel: <br>
                               Fax: <br>
                               Email: <a href="mailto:accounts@skypatches.com">accounts@skypatches.com</a><br>
                               URL: <a href="http://www.skypatches.com">www.skypatches.com</a></p>
                        
                </td>
            </tr>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; 2024 SKYPATCHES & Digitizers. All Rights Reserved.</p>
            {{-- <p>Follow Us:</p> --}}
            <div class="social-icons">
                {{-- <a href="https://facebook.com" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook">
                </a>
                <a href="https://instagram.com" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/1200px-Instagram_logo_2022.svg.png" alt="Instagram">
                </a> --}}
            
            
        </div>
        <p>Stay connected with us for more updates!</p>
    </div>
</body>
</html>
