<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Order Number</strong><br>
                <span>OR-{{ $order->order_id }}</span>
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
                <strong>Height</strong><br>
                <span>{{ $order->height }}"</span>
            </td>
            <td class="col-3">
                <strong>Width</strong><br>
                <span>{{ $order->width }}</span>
            </td>
            <td class="col-3">

            </td>
        </tr>
        <tr class="row">


            <td class="col-3">
                <strong>Format</strong><br>
                <span>{{ $order->format }}</span>

            </td>
            <td class="col-3">
                <strong>Fabric</strong><br>
                <span>{{ $order->fabric_name }}</span>

            </td>
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{ $order->number_of_colors }}</span>

            </td>
            {{-- <td class="col-3">
            <strong>Customer Nick</strong><br>
            <span>{{$order->customer_name}}</span>
        </td> --}}
        </tr>


        <tr class="row">
            <td class="col-3">
                <strong>Placement</strong><br>
                <span>{{ $order->placement }}</span>
            </td>
            <td class="col-3">
                <strong>Stitches A</strong><br>
                <p>
                    {{ $jobInfo->stitches_A ?? '' }}

                </p>
            </td>
            <td class="col-3">
                <strong>Stitches B</strong><br>
                <p>
                    {{ $jobInfo->stitches_B ?? '' }}

                </p>
            </td>
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
                        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension

                    @endphp

                    @if ($filePath)
                        <!-- Check if the file is an image or PDF -->
                        @if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
                            <!-- If the file is an image or PDF, open in a new tab (preview) -->
                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
                                {{ $originalFilename }}
                                {{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
                            </a>
                        @else
                            <!-- For other files, provide download option -->
                            <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}"
                                class="file-link">
                                {{ $originalFilename }}
                            </a>
                        @endif

                        <!-- Checkbox for selection -->
                        {{-- <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked> --}}

                        <!-- Separator and remove button -->
                        {{-- |
                        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order-b" data-file-id="{{ $fileId }}" data-bs-toggle="modal" data-bs-target="#deleteFileBModal">
                            Remove
                        </button> --}}

                        <br>
                    @else
                        <p>No file available</p>
                    @endif
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
                    <strong>Order Status</strong><br>
                </h6>
                <p class="mb-2">{{ $order->order_status_name }}
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
                        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension

                    @endphp
                    @if ($filePath)
                        <!-- Check if the file is an image or PDF -->
                        @if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
                            <!-- If the file is an image or PDF, open in a new tab (preview) -->
                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
                                @if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg']))
                                    <!-- Preview image -->
                                    {{ $originalFilename }}
                                    {{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
                                @else
                                    <!-- Display PDF link -->
                                    {{ $originalFilename }}
                                @endif
                            </a>
                        @else
                            <!-- For other files, provide download option -->
                            <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}"
                                class="file-link">
                                {{ $originalFilename }}
                            </a>
                        @endif

                        <!-- Checkbox for selection -->
                        {{-- <input type="checkbox" name="optionSendFilesA[]" value="{{ $filePath }}" checked> --}}

                        <!-- Separator and remove button -->
                        |
                        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order"
                            data-file-id="{{ $fileId }}" data-bs-toggle="modal"
                            data-bs-target="#deleteFileAModal">
                            Remove
                        </button>

                        <br>
                    @else
                        <p>No file available</p>
                    @endif
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
                      
                        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION); // Get the file extension

                    @endphp


                    @if ($filePath)
                        <!-- Check if the file is an image or PDF -->
                        @if (in_array(strtolower($fileExtension), ['png', 'jpeg', 'jpg', 'pdf']))
                            <!-- If the file is an image or PDF, open in a new tab (preview) -->
                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="file-link">
                                {{ $originalFilename }}
                                {{-- <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $originalFilename }}" style="max-width: 200px; max-height: 200px;"> --}}
                            </a>
                        @else
                            <!-- For other files, provide download option -->
                            <a href="{{ asset('storage/' . $filePath) }}" download="{{ $originalFilename }}"
                                class="file-link">
                                {{ $originalFilename }}
                            </a>
                        @endif

                        <!-- Checkbox for selection -->
                        {{-- <input type="checkbox" name="optionSendFilesB[]" value="{{ $filePath }}" checked> --}}

                        <!-- Separator and remove button -->
                        |
                        <button type="button" class="btn btn-sm rounded-pill btn-danger m-2 delete-file-btn-order-b"
                            data-file-id="{{ $fileId }}" data-bs-toggle="modal"
                            data-bs-target="#deleteFileBModal">
                            Remove
                        </button>

                        <br>
                    @else
                        <p>No file available</p>
                    @endif
                @endforeach
            </td>
        </tr>
    </tbody>
</table>

      