<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Order Number</strong><br>
                <span>OR-{{$order->order_id}}</span>
            </td>
            <td class="col-3">
                <strong>Status</strong><br>
                @if($order->status_id ==2)
                <span>{{$order->status}}</span>
                @elseif($order->status_id ==1)
                <span>{{$order->status}}</span>

                @endif

            </td>
            <td class="col-3">
                <strong>Release Date</strong><br>
                <span>@if(!$order->date_finalized)
                    N/A
                    @endif
                    {{$order->date_finalized}}</span>
            </td>
            <td class="col-3">
                <strong>Received Date</strong><br>
                <span>{{$order->received_date}}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-3">
                <strong>Design Name/PO</strong><br>
                <span>{{$order->design_name}} {{$order->description}}
                </span>
            </td>
            <td class="col-3">
                <strong>Height</strong><br>
                <span>{{$order->height}}"</span>
            </td>
            <td class="col-3">
                <strong>Width</strong><br>
                <span>{{$order->width}}</span>
            </td>
            <td class="col-3">
                <strong>Payable Status</strong><br>
                @if($invoice_status && ($invoice_status->invoiceStatus === 0 || $invoice_status->invoiceStatus === null))
                <!-- Assuming 0 means Unpaid -->
                <span>Payable</span>
            @elseif ($invoice_status && $invoice_status->invoiceStatus === 1)
                <!-- Assuming 1 means Paid -->
                <span>Paid</span>
            @else
                <span>Payable</span>
                <!-- In case neither paymentStatus nor vectorPaymentStatus are available -->
            @endif

            </td>
        </tr>
        <tr class="row">

            <td class="col-3">
                <strong>Format</strong><br>
                <span>{{$order->format}}</span>

                
            </td>
            <td class="col-3">
                <strong>Fabric</strong><br>
                <span>{{$order->fabric_name}}</span>
              
            </td>
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{$order->number_of_colors}}</span>
              
            </td>
            <td class="col-3">
                <strong class="">Price</strong><br>
                <p>{{ $jobInfo->total ?? ''}}</p>
              
              
            </td>
        </tr>

        
        <tr class="row">
            <td class="col-3">
                <strong>Placement</strong><br>
                <span>{{$order->placement}}</span>


            </td>
            <td class="col-3">
                <strong>Stitches A</strong><br>
                <p>
                    {{ $jobInfo->stitches_A ?? ''}}

                </p>
            </td>

            <td class="col-3">
                <strong>Stitches B</strong><br>
                <p>
                    {{ $jobInfo->stitches_B ?? ''}}

                </p>
            </td>

            <td class="col-3">
                <strong>Customer Nick</strong><br>
                <span>{{$order->customer_name}}</span>
            </td>

        </tr>

        <tr class="row">
            <td class="col-6">
               
            </td>
            <td class="col-6">
                <strong class="">Customer Instruction</strong><br>
                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</p>
            </td>
        </tr>

        <tr class="row">
            <td class="col-6">
                {{-- <strong class="">Customer Instruction</strong><br>
                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</p> --}}
            </td>
            <td class="col-6">
                <strong>Admin Instruction</strong><br>
                <p>
                    {{$order->instruction}}

                </p>
            </td>
        </tr>
       
        <tr class="row">
            <td class="col-6">
                <strong class="">Option A</strong><br>
                @foreach ($optionA as $a)
                @php
                    $fileId = $a->fileId;
                    $fileData = json_decode($a->file_upload, true); // Decode the JSON
                    $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                    $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                @endphp
               
                {{ $originalFilename }}
                @endforeach

            </td>
            <td class="col-6">
                <strong>Option B</strong><br>
                @foreach ($optionB as $b)
                @php
                    $fileId = $b->fileId;
                    $fileData = json_decode($b->file_upload, true); // Decode the JSON
                    $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                    $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                @endphp
               
                {{ $originalFilename }}
                @endforeach
            </td>
        </tr>
    </tbody>
</table>
