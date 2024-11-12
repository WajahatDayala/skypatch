@extends('digitizer.quote-worker.quotes.base')
@section('action-content')

         <!-- All Content Goes inside this div -->
         <div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-12">
                        {{-- <div class="bg-table rounded h-100 p-4 mt-4">
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
                        </div> --}}

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
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Width
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Stitches
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Price
                                                </td>
                                                <td class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text" readonly id="basic-addon1">$</span>
                                                        <input type="text" class="form-control" placeholder="Price"
                                                            aria-label="Username" readonly aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                                <td class="col-5">
                                                    <div class="input-group">
                                                        <span class="input-group-text"  id="basic-addon1">$</span>
                                                        <input type="text" readonly class="form-control" placeholder="Price"
                                                            aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="row d-flex align-items-center justify-content-center">
                                                <td class="col-2">
                                                    Total
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
                                                </td>
                                                <td class="col-5">
                                                    <input type="email" readonly class="form-control" id="inputEmail3">
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
                                    @endforeach<br>


                                                    @if ($quote->edit_status == 1)
                                                    <button type="button" class="btn btn-sm rounded-pill btn-primary m-2"
                                                        data-bs-toggle="modal" data-bs-target="#fileUploadModal1">Upload Files</button>
                                                     @endif
                                                       <!-- Modal for Multiple File Upload -->
                                                       <div class="modal fade" id="fileUploadModal1" tabindex="-1" role="dialog"
                                                       aria-labelledby="fileUploadModalLabel1" aria-hidden="true">
                                                       <div class="modal-dialog" role="document">
                                                           <div class="modal-content">
                                                               <div class="modal-header">
                                                                   <h5 class="modal-title" id="fileUploadModalLabel1">Upload Files</h5>
                                                                   <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                       aria-label="Close"></button>
                                                               </div>
                                                               <form id="fileUploadForm1" method="POST"
                                                                   action="{{route('allquotes.optionA')}}"
                                                                   enctype="multipart/form-data">
                                                                   @csrf
                                                                   <div class="modal-body">
                                                                      
                                                                       <div class="form-group">
                                                                           <label hidden for="order_id">Order ID</label>
                                                                           <input type="text" hidden class="form-control" 
                                                                               id="order_id" name="order_id" required
                                                                               value="{{ $quote->quote_id }}">
                                                                       </div>
                                                                       <div class="form-group">
                                                                           <label for="files">Choose Files</label>
                                                                           <input type="file" class="form-control" id="files"
                                                                               name="filesA[]" multiple required>
                                                                       </div>
                                                                   </div>
                                                                   <div class="modal-footer">
                                                                       <button type="button" class="btn btn-secondary"
                                                                           data-bs-dismiss="modal">Close</button>
                                                                       <button type="submit" class="btn btn-primary">Upload</button>
                                                                   </div>
                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
               
                                                   <!-- end file upload-->
                                                     
                                                </td>
                                            </tr>
                                            <tr class="row">
                                                <td>
                                                    {{-- <strong>Comment</strong><br>
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                        id="floatingTextarea" style="height: 150px;"></textarea> 

                                                    <div class="mt-3">
                                                        <legend class="fs-6"><strong>Mail To:</strong></legend>
                                                        <br>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                               {{$quote->email1}}
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->email2}}
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->email3}}
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->email4}}
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="gridCheck1">
                                                            <label class="form-check-label" for="gridCheck1">
                                                            {{$quote->invoceEmail}}
                                                            </label>
                                                        </div>
                                                    </div>--}}
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
                                                    @endforeach<br>
                                                    {{-- <button type="button"
                                                        class="btn btn-primary rounded-pill m-2">Upload Files</button> --}}

                                                        @if ($quote->edit_status == 1)
                                                        <button type="button" class="btn btn-sm rounded-pill btn-primary m-2"
                                                            data-bs-toggle="modal" data-bs-target="#fileUploadModal">Upload Files</button>
                                                       @endif
                                                    <!-- Modal for Multiple File Upload -->
                                                    <div class="modal fade" id="fileUploadModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="fileUploadModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="fileUploadModalLabel">Upload Files</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form id="fileUploadForm" method="POST"
                                                                    action="{{route('allquotes.optionB')}}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                      
                                                                        <div class="form-group">
                                                                            <label hidden for="order_id">Order ID</label>
                                                                            <input type="text" class="form-control" hidden
                                                                                id="order_id" name="order_id" required
                                                                                value="{{ $quote->quote_id }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="files">Choose Files</label>
                                                                            <input type="file" class="form-control" id="files"
                                                                                name="filesB[]" multiple required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <!-- end file upload-->
                                                </td>
                                            </tr>
                                            {{-- <tr class="row">
                                                <td>
                                                    <strong>Comment</strong><br>
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                        id="floatingTextarea" style="height: 150px;"></textarea>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- <div class="row d-flex justify-content-end align-items-center">
                                <div class="col-2 d-flex">
                                    <button type="button" class="btn btn-primary rounded-pill m-2">Send</button>
                                    <button type="button" class="btn btn-dark rounded-pill m-2">Reset</button>
                                </div>
                            </div> --}}
                        </div>


                    </div>
                </div>
            </div>
            <!-- Content Div Ends here End -->
@endsection