@extends('be.user-mgmt.user.base')
@section('action-content')
   
                


 <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Users</h4>
           					     <div class="row">
                                 <div class="col-lg-4"></div>
                                 <div class="col-lg-4 "></div>
                                <div class="col-lg-4 col-xs-offset-right-12"><a style="margin-left: 70%; color:#fff;" class="btn btn-rounded btn-submit_new mb-3" href="{{url('users/create')}}"><i class="fa fa-plus">Add New</i></a></div>
                                </div>
	  
                               
                                <div class="data-tables">
                                    <div class="table-responsive">
                                    <table id="example"  style="width: 100%;" class="table responsive nowrap text-center">
                                        <thead class="bg-light text-capitalize">
                                    <tr style="background: #006D6A; color: #fff;">
								                      <th class="text-center">S No</th>
                                      <th class="text-center">Name</th>
                                      <th class="text-center">Email</th>
                                      <th class="text-center">Role</th>
                                      <th class="text-center">Date</th>
                                      <th class="text-center">Status</th>
                                      <th class="text-center">Action</th>
								                   </tr>
                                </thead>
                                <tbody>
              	                @foreach($users as $u)
								                <tr>
                                <td>{{ $loop->iteration }}</td>
								              	<td>{{$u->firstName}} {{$u->lastName}}</td>
								              	<td>{{ $u->email }}</td>
                                <td>{{ $u->roles_name }}</td>			
								 <td>{{  date('j \\ F Y', strtotime($u->created_at)) }}</td>
                                 <td>@if($u->userActive_status == 1)
                                    <span class="text-success"><b>Active</b></span>
                                    @endif
                                    @if($u->userActive_status == 0)
                                    <span class="text-danger"><b>In Active</b></span>
                                    @endif
                                </td>			
                                <td><form method="post" action="{{ route('users.destroy',$u->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a style="color: #006D6A;" href="{{ URL::to('users/' . $u->id . '/edit') }}"><i class="fa fa-pencil"></i></a>  ||
                  
                                <button  class="btn_delete fa fa-trash" onclick="return confirm('Are you sure to remove to {{$u->firstName}}?')"  type="submit"></button>
                               
                                @foreach($device as $d)
                                @if($u->id == $d->user_id)
                                ||
                                <a href="#" style="color: #006D6A;"  class='viewdetails' data-id='{{ $u->id }}' ><i class="fa fa-eye"></i></a>
                                </form>
                                <!-- Modal -->


      <div class="modal fade bd-example-modal-lg"  id="empModal" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Device Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                <div class="col-md-6">
                                                <label>Device Type</label>
                                               <div class="form-group">
                                               
                                                <input type="text" style="text-align:center;" readonly class="form-control" value="{{$d->device_type}}">
                                               </div>
                                               </div>

                                               <div class="col-md-6">
                                               <label>Fcm Token</label>
                                               <div class="form-group">
                                               
                                                <input type="text" style="text-align:center;" readonly class="form-control" value="{{$d->fcm_token}}">
                                               </div>
                                               </div>

                                               </div>
                                                
                                               <div class="row">
                                                <div class="col-md-6">
                                                <label>Device Name</label>
                                               <div class="form-group">
                                               
                                                <input type="text" style="text-align:center;" readonly class="form-control" value="{{$d->device_name}}">
                                               </div>
                                               </div>

                                               <div class="col-md-6">
                                               <label>Device Os</label>
                                               <div class="form-group">
                                               
                                                <input type="text" style="text-align:center;" readonly class="form-control" value="{{$d->device_os}}">
                                               </div>
                                               </div>

                                               </div>


                                               <div class="row">
                                                <div class="col-md-6">
                                                <label>App Version</label>
                                               <div class="form-group">
                                               
                                                <input type="text" style="text-align:center;" readonly class="form-control" value="{{$d->app_version}}">
                                               </div>
                                               </div>

                                               <div class="col-md-6">
                                               <label>App Build No</label>
                                               <div class="form-group">
                                               
                                                <input type="text" style="text-align:center;"  readonly class="form-control" value="{{$d->app_build_no}}">
                                               </div>
                                               </div>

                                               </div>




                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif
                                @endforeach
                                
                            </td>			
                              
								                </tr>
                                                @endforeach   
                                               

                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->
                 
                   </div>

                  

                            <!-- Script -->
                            <script type='text/javascript'>
   $(document).ready(function(){

      $('#dataTable').on('click','.viewdetails',function(){
          var empid = $(this).attr('data-id');

          if(empid > 0){

             // AJAX request
             var url = "{{ route('getEmployeeDetails',[':empid']) }}";
             url = url.replace(':empid',empid);

             // Empty modal data
             $('#tblempinfo tbody').empty();

             $.ajax({
                 url: url,
                 dataType: 'json',
                 success: function(response){

                     // Add employee details
                     $('#tblempinfo tbody').html(response.html);

                     // Display Modal
                     $('#empModal').modal('show'); 
                 }
             });
          }
      });

   });
   </script>




<!--begin::Toast-->


                <div id="toasts">
                 
                   
            
   @if(session('user'))
                 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Successfully Saved<i class="fa fa-check-circle"></i></strong>
    <br>
     {{session('user')}}
  </div>
   
        @endif        
                </div>


                



<!--end::Toast-->

<script>
	$(document).ready(function() {
	    var table = $('#example').DataTable( {
	      //  lengthChange: false,
	       // buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ]
            
           buttons: [
        {
            extend: 'excel',
            text: 'Export',
            className: 'custom-button-class',
            exportOptions: {
                    columns: ':not(.exclude)'
                }
        }
        ]


	    } );
	 
	    table.buttons().container() 
	        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
	} );
     </script>






                </div>
            </div>
 
@endsection