<!-- resources/views/admin/invoices/invoice_pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="" rel="stylesheet">

    <style>
     
        *{
		font-family: montserrat;
		font-size: 14px;
		}
        p { margin: 0; padding: 0; }
        .ft10 { font-size: 27px; font-family: Times; color: #000000; }
        .ft11 { font-size: 14px; font-family: Times; color: #000000; }
        .ft12 { font-size: 40px; font-family: Times; color: #000000; }
        .ft13 { font-size: 14px; font-family: Times; color: #0462c1; }
        .ft14 { font-size: 16px; font-family: Times; color: #000000; }
        .ft15 { font-size: 16px; font-family: Times; color: #0462c1; }
        .ft16 { font-size: 14px; line-height: 22px; font-family: Times; color: #000000; }
        .ft17 { font-size: 16px; line-height: 21px; font-family: Times; color: #000000; }

        /* General Page Styles */
        body {
          
            font-family: Times, serif;
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
            padding: 20px;
          
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            border: 1px solid #000;
            box-sizing: border-box;
            height: 180px;
            margin-bottom: 40px;
        }

        .title-left {
            font-size: 27px;
            margin-left: 20px;
            line-height: 100px;
        }

        .invoice-box {
            font-size: 40px;
            margin-right: 20px;
            text-align: right;
            line-height: 100px;
            font-family: montserrat;
        }

        /* Invoice Details Box */
        .invoice-details {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            box-sizing: border-box;
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
        }

        th {
            background-color: #f2f2f2;
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
            padding: 20px;
            border: 1px solid #000;
            text-align: center;
            margin-top: 20px; /* Add margin to separate from content */
            box-sizing: border-box;
        }

        /* Page Break and Flexbox Handling */
        .page-break {
            page-break-before: always;
        }
        .logo{
            filter: none; /* Reset any image filter */
        }
    </style>
    <style>
  @import url('"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
</style>
</head>
<body>

      <!-- Header Box with SkyPatches and Invoice -->
      <div class="header-box">
          
          <p class="title-left ft10">
          <img class="logo" src="{{ public_path('storage/skypatch/img/logo_resized.png') }}" alt="Logo">
            
             </p>
          <p class="invoice-box ft12">Invoice</p>
      </div>

      <!-- Invoice Details (Invoice # and Date) -->
      <div class="invoice-details">
          <div><p class="ft11">Invoice #: {{ $invoice->id }}</p></div>
          <div><p class="ft11">Date: {{ $invoice->created_at->format('Y-m-d') }}</p></div>
      </div>

      <!-- Customer Information Box -->
      <div class="customer-box">
          <div class="customer-info">
              <p class="ft11"><b>Customer’s Information</b></p>
              <p class="ft11">Company: The Info</p>
              <p class="ft11">Name: John Doe</p>
              <p class="ft11">Email: <a href="mailto:john@test.com" class="ft13">john@test.com</a></p>
              <p class="ft11">Address:</p>
          </div>
      </div>

      <!-- Order Information -->
      <p style="margin-top: 70px;" class="ft14"><b>Order Information</b></p>

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
                  <tr>
                      <td>1</td>
                      <td>OR-1147312</td>
                      <td>2man gear</td>
                      <td>Paid</td>
                      <td>2024-04-22 10:14:20</td>
                      <td>2024-04-22 21:41:58</td>
                      <td>$35.00</td>
                  </tr>
              </tbody>
              <tfoot>
                  <tr>
                      <td style="border-left: hidden; border-bottom: hidden;"></td>
                      <td style="border-left: hidden; border-bottom: hidden;"></td>
                      <td style="border-left: hidden; border-bottom: hidden;"></td>
                      <td style="border-left: hidden; border-bottom: hidden;"></td>
                      <td style="border-left: hidden; border-bottom: hidden;"></td>
                      <!-- Total label spans 6 columns -->
                      <td>Total</td>
                      <!-- Price aligned to the right -->
                      <td>$35.00</td>
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
