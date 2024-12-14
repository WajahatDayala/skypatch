@extends('reports.base')
@section('action-content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- All Content Goes inside this div -->
    <!-- All Content Goes inside this div -->
    <div class=" container-fluid py-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row mb-4">
                        <div class="col-6 d-flex justify-content-start align-items-center">
                            <h6 class="h6 mb-0">Designer Report</h6>
                        </div>
                    </div>


                    <form action="{{ route('designer-report.result') }}" method="GET">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" required name="from_date">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" required name="to_date">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Designer</label>

                                    <select class="form-control" name="designer_id">
                                        <option value="">All Designer</option>
                                        <!-- Default option with empty value -->
                                        @foreach ($designer as $d)
                                            <option value="{{ $d->employeeId }}" 
                                                @if(old('designer_id', request('designer_id')) == $d->employeeId) selected @endif>
                                                {{ $d->employeeName }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="col-md-2 ml-6">

                                <button type="submit" class="btn btn-primary rounded-lg m-4"
                                    name="btn-search">Search</button>

                            </div>
                    </form>

                    <!-- for all designer -->
                    @php
                        $fromDate = $_GET['from_date'];
                        $toDate = $_GET['to_date'];
                        $desingerId = $_GET['designer_id'];
                    @endphp
                    @if($fromDate && $toDate && !$desingerId)
                    <div class="table-responsive">
                        <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center"> ID </th>
                                    <th class="text-center"> Name </th>
                                    <th class="text-center"> Free </th>
                                    <th class="text-center"> Edit </th>
                                    <th class="text-center"> New </th>
                                    <th class="text-center"> Revision </th>
                                    <th class="text-center"> All Quotes (including edit/revision) </th>
                                    <th class="text-center"> Edit/Revision </th>
                                    <th class="text-center"> Converted Quotes </th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalSales = 0;
                                @endphp
                                @foreach ($ordersData as $s)
                                    <tr>
                                        {{-- <td class="text-center">{{ $loop->iteration }}</td> --}}
                                        <td class="text-center">{{ $s->designerId }}</td>
                                        <td class="text-center">{{ $s->designerName }}</td>
                                        <td class="text-center">{{ $s->Free }}</td>
                                        <td class="text-center">{{ $s->Edit }}</td>
                                        <td class="text-center">{{ $s->New }}</td>
                                        <td class="text-center">{{ $s->Revision }}</td>
                                        <td class="text-center">{{ $s->All_Quotes }}</td>
                                        <td class="text-center">{{ $s->Edit_Revision_Quotes }}</td>
                                        <td class="text-center">{{ $s->ConvertedQuote }}</td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif


                    <!--for single designer -->
                 <!--for single designer -->
@if($fromDate && $toDate && $desingerId)
<div class="accordion accordion-flush" id="accordionFlushExample">
    <!-- New -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                New
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable1" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Order No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $newOrderCount =0;
                            @endphp
                            @foreach ($newOrder as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">OR-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                                @php
                                $newOrderCount++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End New -->

    <!-- Edit -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Edit
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable2" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Order No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $editOrderCount =0;
                            @endphp
                            @foreach ($editOrder as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">OR-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                            @php
                             $editOrderCount ++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit -->

    <!-- Revision -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Revision
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable3" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Order No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $revisionOrderCount =0;
                            @endphp
                            @foreach ($revisionOrder as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">OR-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                                @php
                                 $revisionOrderCount ++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Revision -->

    <!-- Free -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                Free
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable4" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Order No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                             $freeOrderCount =0;
                            @endphp
                            @foreach ($freeOrder as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">OR-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                                @php 
                                 $freeOrderCount ++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Free -->

    <!-- All Quotes -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                All Quotes
            </button>
        </h2>
        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable5" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Quote No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Quote Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $allQuoteCount =0;
                           @endphp
                            @foreach ($allquotes as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">QT-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                                @php 
                                $allQuoteCount ++;
                               @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Quotes -->

    <!-- Edit Quotes -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                Edit Quotes
            </button>
        </h2>
        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable6" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Quote No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Quote Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $editQuotesCount =0;
                           @endphp
                            @foreach ($editquotes as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">QT-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                                @php
                                  $editQuotesCount ++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Quotes -->

    <!-- Quotes Converted to Orders -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingSeven">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                Quotes Converted To Order
            </button>
        </h2>
        <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table id="dataTable7" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">S#</th>
                                <th class="text-center">Order No</th>
                                <th class="text-center">Design Name</th>
                                <th class="text-center">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $convertedQuoteCount =0;
                            @endphp
                            @foreach ($convertQuoteToOrder as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">OR-{{$s->id}}</td>
                                    <td class="text-center">{{ $s->designName }}</td>
                                    <td class="text-center">{{ $s->created_at }}</td>
                                </tr>
                                @php 
                               $convertedQuoteCount ++;
                             @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Quotes Converted to Orders -->

    <!-- Summary -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingEight">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                Summary
            </button>
        </h2>
        <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <b>New</b>: {{$newOrderCount;}}<br>
                <b>Free</b>: {{$freeOrderCount}}<br>
                <b>Total Orders</b>:@php $totalOrders = $newOrderCount  + $freeOrderCount + $editOrderCount+$revisionOrderCount @endphp {{$totalOrders}}<br>
                <b>Edit</b>:{{$editOrderCount;}}<br>
                <b>Revision</b>: {{$revisionOrderCount;}}<br>
                <b>All Quotes</b>:{{$allQuoteCount;}}<br>
                <b>Edit Quotes</b>: {{$editQuotesCount;}}<br>
                <b>Quotes Converted To Order</b>: {{$convertedQuoteCount;}}<br>
                <b>Total</b>: @php
                // Assuming the individual counts are already defined
                $totalQuotes = $convertedQuoteCount + $revisionOrderCount + $editQuotesCount + $allQuoteCount + $freeOrderCount + $editOrderCount + $newOrderCount;
            @endphp
             {{$totalQuotes}}
             
            </div>
        </div>
    </div>
    <!-- End Summary -->

</div>
@endif




                    <!--row end div-->
                </div>





            </div>
        </div>
        <!-- Content Div Ends here End -->


        <script>
            $(document).ready(function() {
                $('#dataTable1').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });

            //2 
            $(document).ready(function() {
                $('#dataTable2').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });
            //3
            $(document).ready(function() {
                $('#dataTable3').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });
            //4
            $(document).ready(function() {
                $('#dataTable4').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });
             //5
            $(document).ready(function() {
                $('#dataTable5').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });

            //6
            $(document).ready(function() {
                $('#dataTable6').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });


            $(document).ready(function() {
                $('#dataTable7').DataTable({
                    paging: true,                  // Enable paging
                    searching: true,               // Enable search
                    ordering: true,                // Enable column sorting
                    info: true,                    // Show table information
                    pageLength: 10,                // Set default number of rows per page
                    lengthMenu: [10, 25, 50, 100], // Option to select number of rows per page
                    language: {
                        search: "Filter records:",  // Custom search label
                        lengthMenu: "Show _MENU_ entries",  // Custom length menu label
                        info: "Showing _START_ to _END_ of _TOTAL_ entries" // Custom info label
                    },
                    order: [[ 0, 'asc' ]],         // Default sorting by the first column (ascending)
                    columnDefs: [
                        { targets: 0, orderable: false } // Disable sorting for the first column
                    ]
                });
            });
        </script>
        



        <!-- Content Div Ends here End -->
    @endsection
