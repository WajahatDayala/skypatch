@extends('digitizer.quote-worker.quotes.base')
@section('action-content')

         <!-- All Content Goes inside this div -->
         <div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-12">
                        

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-dark p-2">
                                <h6 class="text-light fw-light text-center mb-0">For Digitzer's/Vector Teams</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong># of Machine(s)</strong><br>
                                            <span> {{ old('machine', $vectordetails->machine ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Condition</strong><br>
                                            <span> {{ old('condition', $vectordetails->condition ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Needles</strong><br>
                                            <span> {{ old('needles', $vectordetails->needles ?? '') }}</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Thread</strong><br>
                                            <span> {{ old('thread', $vectordetails->thread ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Brand</strong><br>
                                            <span> {{ old('needle_brand', $vectordetails->needle_brand ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing(Pique / Jersey)</strong><br>
                                            <span> {{ old('backing_pique_jersey', $vectordetails->backing_pique_jersey ?? '') }}</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Brand</strong><br>
                                            <span> {{ old('brand', $vectordetails->brand ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cotton / Twill)</strong><br>
                                            <span> {{ old('backing_cotton_twill', $vectordetails->backing_cotton_twill ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cap)</strong><br>
                                            <span> {{ old('backing_cap', $vectordetails->backing_cap ?? '') }}</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Model</strong><br>
                                            <span> {{ old('model', $vectordetails->model ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Number</strong><br>
                                            <span> {{ old('needle_number', $vectordetails->needle_number ?? '') }}</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Heads</strong><br>
                                            <span> {{ old('heads', $vectordetails->head ?? '') }}</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comments</strong><br>
                                            <span> {{ old('comments', $vectordetails->comment_box ?? '') }}</span>
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
                      
                       <!-- job information -->
                       @include('digitizer.quote-details.jobinfo')


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