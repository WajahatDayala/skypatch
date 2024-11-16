@extends('admin.quotes.base')
@section('action-content')

         <!-- All Content Goes inside this div -->
         <div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">Pricing Criteria</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Minimum Price</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Maximum Price</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>1000 Stitches</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Normal Delivery</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Editing/Changes</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Editing in stiches file</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>

                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Commment Box 1</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Comment Box 2</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Comment Box 3</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comment Box 4</strong><br>
                                            <span></span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">For Digitzer's/Vector Teams</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong># of Machine(s)</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Condition</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Needles</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Thread</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Brand</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing(Pique / Jersey)</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Brand</strong><br>
                                            <span>psd</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cotton / Twill)</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cap)</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Backing</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Number</strong><br>
                                            <span></span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Heads</strong><br>
                                            <span></span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comments</strong><br>
                                            <span></span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <!-- Modal for Reason -->
                            <div class="modal fade" id="Reason" tabindex="-1" aria-labelledby="ReasonLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ReasonLabel">Reasons</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="row mb-3">
                                                    <label for="reasonSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Reason *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" id="reasonSelect"
                                                            aria-label="Default select example">
                                                            <option selected class='text-gray'>Select Format</option>
                                                            <option value="1">Sales</option>
                                                            <option value="2">Support</option>
                                                            <option value="3">Accounts</option>
                                                            <option value="4">Digitizer Leader</option>
                                                            <option value="5">Digitizer</option>
                                                            <option value="6">Vector Artist Leader</option>
                                                            <option value="7">Vector Artist</option>
                                                            <option value="8">Quote Digitizer Leader</option>
                                                            <option value="9">Quote Digitizer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Reason Ends Here -->

                            <!-- Modal for Edit Designer Start Here -->
                            <div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DesignerLabel">Designer Assignment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="row mb-3">
                                                    <label for="designerSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Designer
                                                        *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" id="designerSelect"
                                                            aria-label="Default select example">
                                                            <option selected class='text-gray'>Select Designer</option>
                                                            <option value="1">Designer 1</option>
                                                            <option value="2">Designer 2</option>
                                                            <option value="3">Designer 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Designer Ends Here -->

                        </div>

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">Job Information</h1>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Number</strong><br>
                                                    <span>QT-{{$quote->quote_id}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Date & Time</strong><br>
                                                    <span>{{$quote->received_date}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Customer Nick</strong><br>
                                                    <span>{{$quote->customer_name}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Desing Namw/PO</strong><br>
                                                    <span>{{$quote->design_name}}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Height</strong><br>
                                                    <span>{{$quote->height}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Width</strong><br>
                                                    <span>{{$quote->width}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Required Format</strong><br>
                                                    <span>{{$quote->format}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Placement</strong><br>
                                                    <span>{{$quote->placement}}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-3">
                                                    <strong>Number of Colors</strong><br>
                                                    <span>{{$quote->number_of_colors}}</span>
                                                </td>
                                                <td class="col-3">
                                                    <strong>Fabric Type</strong><br>
                                                    <span>{{$quote->fabric_name}}</span>
                                                </td>
                                                <td class="col-6">
                                                    <strong>Design Type</strong><br>
                                                    <span></span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-12">
                                                    <strong>Customer Instructions</strong><br>
                                                    <span>{{ $quoteInstruction ? $quoteInstruction->instruction : 'No instruction available.' }}</span>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-12">
                                                    <strong>Admin Instructions</strong><br>
                                                    <span>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }} </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-5">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Height
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" class="form-control" id="inputEmail3">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Width
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" class="form-control" id="inputEmail3">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Stitches
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" class="form-control" id="inputEmail3">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Price
                                                </td>
                                                <td class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="number" id="price_A" class="form-control" placeholder="Price"
                                                            aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                                <td class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="number" id="price_B" class="form-control" placeholder="Price"
                                                            aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Total
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" class="form-control" id="total_A" readonly>
                                                </td>
                                                <td class="col-5">
                                                    <input type="number" class="form-control" id="total_B" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row">
                                <div class="col-6 border-end">
                                    <div class="row bg-dark p-2">
                                        <h6 class="text-light fw-light text-center mb-0">Option A</h1>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            
                                            <tr class="row">
                                                <td>
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
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-primary rounded-pill m-2">Upload Files</button>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td>
                                                    <strong>Comment</strong><br>
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                        id="floatingTextarea" style="height: 150px;"></textarea>

                                                    <div class="mt-3">
                                                        <legend class="fs-6"><strong>Mail To:</strong></legend>
                                                        <br>
                                                        <div class="form-check">
                                                            @if($quote->email1)
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                             
                                                               {{$quote->email1}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->email2)
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->email2}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->email4)
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->email3}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->email4)
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->email4}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                        <div class="form-check">
                                                            @if($quote->invoceEmail)
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->invoceEmail}}
                                                            </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6 border-start">
                                    <div class="row bg-dark p-2">
                                        <h6 class="text-light fw-light text-center mb-0">Option B</h1>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            
                                                
                                            <tr class="row">
                                                <td>
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
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-primary rounded-pill m-2">Upload Files</button>
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td>
                                                    <strong>Comment</strong><br>
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                        id="floatingTextarea" style="height: 150px;"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-2 d-flex">
                                    <button type="button" class="btn btn-primary rounded-pill m-2">Send</button>
                                    <button type="button" class="btn btn-dark rounded-pill m-2">Reset</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- Content Div Ends here End -->

            <!-- Add this script to enable dynamic price updates -->
<script>
    // Get elements
    const priceA = document.getElementById('price_A');
    const priceB = document.getElementById('price_B');
    const totalA = document.getElementById('total_A');
    const totalB = document.getElementById('total_B');

    // Add event listeners to update totals when prices change
    priceA.addEventListener('input', function() {
        totalA.value = priceA.value; // Set total A to the value of price A
    });

    priceB.addEventListener('input', function() {
        totalB.value = priceB.value; // Set total B to the value of price B
    });
</script>
@endsection