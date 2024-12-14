<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Vector Number</strong><br>
                <span>VO-{{ $order->order_id }}</span>
            </td>
            <td class="col-3">
                <strong>Status</strong><br>
                @if ($order->status_id == 2)
                    <span>{{ $order->status }}</span>
                @elseif($order->status_id == 1)
                    <span>{{ $order->status }}</span>
                @endif

            </td>
            <td class="col-3">
                <strong>Release Date</strong><br>
                <span>
                    @if (!$order->date_finalized)
                        N/A
                    @endif
                    {{ $order->date_finalized }}
                </span>
            </td>
            <td class="col-3">
                <strong>Received Date</strong><br>
                <span>{{ $order->received_date }}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-3">
                <strong>Design Name/PO</strong><br>
                <span>{{ $order->design_name }} {{ $order->description }}
                </span>
            </td>
           
            <td class="col-3">
                <strong>Format</strong><br>
                <span>{{ $order->format }}</span>
            </td>

            
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{ $order->number_of_colors }}</span>
            </td>
        </tr>
        <tr class="row">

          
           
            {{-- <td class="col-3">
            <strong>Customer Nick</strong><br>
            <span>{{$order->customer_name}}</span>
        </td> --}}
        </tr>


        <tr class="row">
            {{-- <td class="col-6">
            <strong class="">Price</strong><br>
            <p></p>
                <!-- <button type="button"
                                class="btn btn-sm rounded-pill btn-primary m-2">Update</button> -->

        </td> --}}
            
        </tr>

        <tr class="row">
            <td class="col-6">
                <strong>Files</strong><br>
                @foreach ($orderFiles as $f)
                    @php
                        $fileId = $f->fileId;
                        $fileData = json_decode($f->files, true); // Decode the JSON
                        $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                        $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                    @endphp
                    <span class="text-info">{{ $originalFilename }}

                    </span>
                @endforeach


            </td>
            <td class="col-6">

                
                <strong class="">Customer Instruction</strong><br>
                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}
                   
                </p>



            </td>
        </tr>
        <tr class="row">

          
                <td class="col-3">
                    <h6>
                     

                        @if (!$order->designer_id)
                            <strong class="text-danger">
                                Not Assign
                            </strong>
                        @else
                            <strong class="text-info">
                                {{ $order->designer_name }}
                            </strong>
                        @endif
                    </h6>
                    <!-- <p>John Doe</p> -->
                </td>
        


               <td class="col-3">
                    <h6>
                        <strong>Vector Status</strong><br>
                    </h6>
                    <p class="mb-2">{{ $order->order_status_name }}

                    
                    <!-- order status end-->
                    </p>

                </td>
           
            <td class="col-6">
                <strong>Admin Instruction</strong><br>

                <p>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }}
                   
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