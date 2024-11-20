<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            color: #000000;
        }
        th, td {
            border: 1px solid #000000;
            padding: 10px;
            text-align: center;
        }
        th {
            font-size: 18px;
        }
        .center {
            text-align: center;
        }
        .two-columns {
            width: 50%;
        }
        .design-header th {
            width: 25%; /* Set equal width for design options */
        }
        .normal-width {
            width: auto; /* Normal width for other columns */
        }
        *{
		font-family: montserrat;
		font-size: 14px;
		}
	td.heading {
		font-size: 35px;
		font-weight: 600;
	}
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>
<body>

    <table>
        <tr>
        <td class="heading" colspan="4" class="center">SKYPATCHES</td>
        </tr>
        <tr>
            <td colspan="4" class="center" style="font-size: 5px;"><b>Quote - {{$order->order_status_name}}</b></td>
        </tr>
        <tr>
			<td class="normal-width"><b>Number</b></td>
            <td class="normal-width">QT-{{$order->order_id}}</td>
            <td class="normal-width"><b>Status</b></td>
            <td class="normal-width">{{$order->status}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Customer ID</b></td>
            <td class="normal-width">{{$order->customer_id}}</td>
            <td class="normal-width"><b>Received Date</b></td>
            <td class="normal-width">{{$order->received_date}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Design Name/ PO</b></td>
            <td class="normal-width">{{$order->design_name}}</td>
            <td class="normal-width"><b>Sent Date</b></td>
            <td class="normal-width">{{$order->sent_date}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Required Format</b></td>
            <td class="normal-width">{{$order->format}}</td>
            <td class="normal-width"><b>Height</b></td>
            <td class="normal-width">{{$order->height}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Placement</b></td>
            <td class="normal-width">{{$order->placement}}</td>
            <td class="normal-width"><b>Width</b></td>
            <td class="normal-width">{{$order->width}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Fabric Type</b></td>
            <td class="normal-width">{{$order->fabric_name}}</td>
            <td class="normal-width"><b>Number of Colors</b></td>
            <td class="normal-width">{{$order->number_of_colors}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Super Urgent</b></td>
            <td class="normal-width">{{$order->super_urgent ==1?'Yes':'No'}}</td>
            <td class="normal-width"><b>Design Type</b></td>
            <td class="normal-width"></td>
        </tr>
        <tr>
            <td class="normal-width"><b>Customer Comments</b></td>
            <td colspan="3">{{$orderInstruction ? $orderInstruction->instruction: ''}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Additional Comments</b></td>
            <td colspan="3">{{ $adminInstruction ? $adminInstruction->instruction : ''}}</td>
        </tr>
        <tr>
            <td class="normal-width"><b>Designer Note</b></td>
            <td class="two-columns" colspan="3"></td>
        </tr>
        <tr class="design-header">
            <th><b>Design</b></th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
        </tr>
        <tr>
            <td><b>Height</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Width</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>No. Of Stitches</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>No. Of Colors</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Heights No. Of Trims</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>No. Of Sewout</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Machine</b></td>
            <td></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td><b>Comments</b></td>
            <td colspan="3">Always PES</td>
        </tr>
        <tr>
            <th>Approved By</th>
            <th>Approved By</th>
            <th>Sent By</th>
            <th>Digitized By</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$order->designer_name}}</td>
        </tr>
    </table>

</body>
</html>
