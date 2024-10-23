@extends('admin.orders.base')
@section('action-content')

<!-- All Content Goes inside this div -->
<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="bg-table rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Order Details</h6>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <button type="button"
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button> 
                        @if($order->edit_status ==1)
                        <a type="button" href="{{ route('allorders.edit', ['allorder' => $order->order_id]) }}"
                                        class="btn btn-sm btn-dark rounded-pill ">Process</a>
                        @endif
                    </div>
                </div>
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
                                <strong>Format</strong><br>
                                <span>{{$order->format}}</span>
                            </td>
                        </tr>
                        <tr class="row">

                            <td class="col-3">
                                <strong>Fabric</strong><br>
                                <span>{{$order->fabric_name}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Number of Colors</strong><br>
                                <span>{{$order->number_of_colors}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Placement</strong><br>
                                <span>{{$order->placement}}</span>
                            </td>
                            <td class="col-3">
                                <strong>Customer Nick</strong><br>
                                <span>{{$order->customer_name}}</span>
                            </td>
                        </tr>

                        
                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Price</strong><br>
                                <p></p>
                                    <!-- <button type="button"
                                                    class="btn btn-sm rounded-pill btn-primary m-2">Update</button> -->

                            </td>
                            <td class="col-6">
                                <strong>Stitching </strong><br>
                                <p>
                                   

                                </p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Customer Instruction</strong><br>
                                <p>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</p>
                            </td>
                            <td class="col-6">
                                <strong>Admin Instruction</strong><br>
                                <p>
                                    {{$order->instruction}}

                                </p>
                            </td>
                        </tr>
                       <tr class="row">

                       @if($order->edit_status ==1) 
                       <td class="col-3">
                                            <h6>
                                                <!-- <strong><a href="" class="text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Not Assigned</a></strong><br>
                                                <strong class="text-info"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Assigned</a></strong><br> -->
                               
                                                      
                                @if(!$order->designer_id)
                               
                                 <strong>
                                <a href="#" class="text-danger" 
                                     data-bs-toggle="modal" 
                                     data-bs-target="#Designer" 
                                     data-id="{{ $order->order_id }}">Not Assigned</a>
                                </strong>
                                 @else
                                 <strong class="text-info" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#Designer" 
                                 data-id="{{ $order->order_id }}" 
                                 data-leader-id="{{ $order->designer_id }}">
                                {{ $order->designer_name }}
                                </strong>
                                @endif
                                            </h6>
                                            <!-- <p>John Doe</p> -->
                            </td>
                            @else
                            <td class="col-3">
                                            <h6>
                                                <!-- <strong><a href="" class="text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Not Assigned</a></strong><br>
                                                <strong class="text-info"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Assigned</a></strong><br> -->
                               
                                                      
                                @if(!$order->designer_id)
                               
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
                            
                            @endif



                                        @if($order->edit_status ==1)
                                        <td class="col-3">
                                            <h6>
                                                <strong>Order Status</strong><br>
                                            </h6>
                                            <p class="mb-2">New |
                                                
                                                <button type="button"
                                                    class="btn btn-sm rounded-pill btn-dark ms-2">Update</button>
                                                    
                                                </p>
                                            <p class="mb-0">Reason |
                                                <button type="button" class="btn btn-sm rounded-pill btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#Reason">
                                                  
                                                    Reason Not Specified
                                                    
                                                </button>
                                            </p>
                                        </td>
                                        @else
                                        <td class="col-3">
                                        <h6>
                                                <strong>Order Status</strong><br>
                                            </h6>
                                            <p class="mb-2">New |
                                                
                                               
                                                    
                                                </p>
                                            <p class="mb-0">Reason |
                                                
                                                  
                                                    Reason Not Specified
                                                    
                                               
                                            </p>

                                        </td>
                                        @endif
                                        <td class="col-6">
                                            <strong>Files</strong><br>
                                            @foreach($orderFiles as $f)
                                            @php
                                            $fileData = json_decode($f->files, true); // Decode the JSON
                                            $filePath = $fileData['path'] ?? 'No file'; // Get the file path
                                            $originalFilename = $fileData['original_name'] ?? 'Unknown'; // Get the original filename
                                            @endphp
                                            <span class="text-info"><!--QT-54325-filename.psd--> {{ $originalFilename }} 
                                            @if($order->edit_status ==1) | 
                                            <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            @endif
                                            @endforeach
                                            <!-- <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                     class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <button type="button" class="btn btn-sm rounded-pill btn-primary m-2">Attech
                                                Files</button> -->
                                        </td>
                                    </tr>
                        <tr class="row">
                            <td class="col-6">
                                <strong class="">Option A</strong><br>
                            </td>
                            <td class="col-6">
                                <strong>Option B</strong><br>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Modal for Reason -->
                <div class="modal fade" id="Reason" tabindex="-1" aria-labelledby="ReasonLabel" aria-hidden="true">
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
                                        <label for="reasonSelect" class="col-sm-4 col-form-label text-end">Select Reason
                                            *</label>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for Edit Reason Ends Here -->

                <!-- Modal for Edit Designer Start Here -->
                                           

<div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DesignerLabel">Designer Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignLeaderForm" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" id="employee_id">
                    <div class="row mb-3">
                        <label for="designerSelect" class="col-sm-4 col-form-label text-end">Select Designer *</label>
                        <div class="col-sm-8">
                            <select name="designer_id" class="form-select" id="designerSelect" required>
                                <option selected class='text-gray' value="">Select Designer</option>
                                @foreach($designer as $l)
                                <option value="{{ $l->designer_id }}">{{ $l->designerName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
            </div>
        </div>
    </div>
</div>
                <!-- Modal for Edit Designer Ends Here -->

            </div>

            <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-info p-2">
                                <h6 class="text-secondary text-center mb-0">For Digitzer's/Vector Teams</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong># of Machine(s)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Condition</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Needles</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Thread</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Brand</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing(Pique / Jersey)</strong><br>
                                            <span>lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Brand</strong><br>
                                            <span>psd</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cotton / Twill)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cap)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Backing</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Number</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Heads</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comments</strong><br>
                                            <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni
                                                possimus perspiciatis ad dicta, incidunt accusamus. Voluptatibus, veniam
                                                laboriosam! Vitae, iure.</span>
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

        </div>
    </div>
</div>
<!-- Content Div Ends here End -->

<script>
    var designerModal = document.getElementById('Designer');
    designerModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var employeeId = button.getAttribute('data-id'); // Extract employee ID
        var leaderId = button.getAttribute('data-leader-id'); // Extract leader ID if assigned

        // Set the employee ID in the form
        document.getElementById('employee_id').value = employeeId;

        // Set the selected leader if already assigned
        var designerSelect = document.getElementById('designerSelect');
        designerSelect.value = leaderId || ''; // Set to selected leader or reset

        // Set the form action URL for updating the leader
        var form = document.getElementById('assignLeaderForm');
        form.action = '{{ url('admin/allorders') }}/' + employeeId + '/allorder';
    });

    document.getElementById('saveChangesButton').addEventListener('click', function () {
        document.getElementById('assignLeaderForm').submit(); // Submit the form
    });
</script>




@endsection