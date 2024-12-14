<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Quote Number</strong><br>
                <span>QT-{{$quote->order_id}}</span>
            </td>
            <td class="col-3">
                <strong>Status</strong><br>
                @if($quote->status_id ==2)
                <span>{{$quote->status}}</span>
                @elseif($quote->status_id ==1)
                <span>{{$quote->status}}</span>

                @endif

            </td>
            <td class="col-3">
                <strong>Release Date</strong><br>
                <span>@if(!$quote->date_finalized)
                    N/A
                    @endif
                    {{$quote->date_finalized}}</span>
            </td>
            <td class="col-3">
                <strong>Received Date</strong><br>
                <span>{{$quote->received_date}}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-3">
                <strong>Design Name/PO</strong><br>
                <span>{{$quote->design_name}} {{$quote->description}}
                 
                </span>
            </td>
            <td class="col-3">
                <strong>Height</strong><br>
                <span>{{$quote->height}}"</span>
            </td>
            <td class="col-3">
                <strong>Width</strong><br>
                <span>{{$quote->width}}</span>
            </td>
            <td class="col-3">
              
                <strong class="">Price</strong><br>
                <p>{{ $jobInfo->total ?? ''}}</p>
            </td>
        </tr>
        <tr class="row">

            <td class="col-3">
                <strong>Format</strong><br>
                <span>{{$quote->format}}</span>

            </td>
            <td class="col-3">
                
                <strong>Fabric</strong><br>
                <span>{{$quote->fabric_name}}</span> 

               
            </td>
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{$quote->number_of_colors}}</span>


            </td>
            <td class="col-3">
               
            </td>
        </tr>


        <tr class="row">
            <td class="col-3">
               <strong>Placement</strong><br>
                    <span>{{$quote->placement}}</span>
                                  
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
                <span>{{$quote->customer_name}}</span>
            </td>

        </tr>  

        <tr class="row">
            <td class="col-6">
              
                    <!-- <button type="button"
                                    class="btn btn-sm rounded-pill btn-primary m-2">Update</button> -->

            </td>
            <td class="col-6">
                <strong class="">Customer Instruction</strong><br>
                <p>{{ $quoteInstruction ? $quoteInstruction->instruction : 'No instruction available.' }}</p>
            </td>
        </tr>

        <tr class="row">
            <td class="col-6">
              
            </td>
            <td class="col-6">
                <strong>Admin Instruction</strong><br>
                <p>
                    {{$quote->instruction}}

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