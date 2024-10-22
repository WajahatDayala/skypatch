@extends('admin.customers.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">Assign Leaders To Designers</h6>

                </div>
                 <!-- <div class="row">
                                 <div class="col-lg-4"></div>
                                 <div class="col-lg-4 "></div>
                                <div class="col-lg-4 col-xs-offset-right-12"><a style="margin-left: 70%; color:#fff;" class="btn btn-rounded btn-primary mb-3" href="{{url('admin/employees/create')}}"><i class="fa fa-plus">Add New</i></a></div>
                                </div>
                 -->
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> Name </th>
                             
                                <th scope="col"> Leaders </th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee as $e)
                          
                            <tr>
                              
                                <td> {{ $loop->iteration }}</td>
                             
                                <td> {{$e->employeeName}} </td>
                               
                           
                                <td>
                                    <!-- <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="{{ route('employees.show', ['employee' => $e->id]) }}">Details</a>

                                        <a class="btn btn-sm btn-primary rounded-pill m-2"
                                        href="">records</a> -->
                                    @if(!$e->leader_id)
                                    <strong><a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#Designer" data-id="{{ $e->employeeId }}">Not Assigned</a></strong>
                                    @else
                                    <!-- <strong class="text-info"><a href="#" data-bs-toggle="modal" data-bs-target="#Designer" data-id="{{ $e->employeeId }}" data-leader-id="{{ $e->leader_id }}">{{ $e->leaderName }}</a></strong> -->
                                    <strong class="text-info" data-bs-toggle="modal" data-bs-target="#Designer" data-id="{{ $e->EmployeeId }}" data-leader-id="{{ $e->leader_id }}">{{$e->leaderName}}</strong>
                                    @endif
                                     
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    </div>
</div>
 
<!-- Blank End -->
   
                             
<!-- Modal for Edit Leaders -->
<div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DesignerLabel">Leader Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignLeaderForm" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" id="employee_id">
                    <div class="row mb-3">
                        <label for="designerSelect" class="col-sm-4 col-form-label text-end">Select Leader *</label>
                        <div class="col-sm-8">
                            <select name="leader_id" class="form-select" id="designerSelect" required>
                                <option selected class='text-gray' value="">Select Leader</option>
                                @foreach($leaders as $l)
                                <option value="{{ $l->id }}">{{ $l->leaderName }}</option>
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
        form.action = '{{ url('admin/assign-leaders') }}/' + employeeId + '/assign-leader';
    });

    document.getElementById('saveChangesButton').addEventListener('click', function () {
        document.getElementById('assignLeaderForm').submit(); // Submit the form
    });
</script>




@endsection