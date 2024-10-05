@extends('be.user-mgmt.user.base')
@section('action-content')


  <div class="col-lg-12 col-ml-12">
                        <div class="row">
                            <!-- basic form start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                      @if ($errors->any())
                                       <div class="alert alert-danger">
                                       <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                      <ul>
                                      @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                      @endforeach
                                     </ul>
                                     </div>
                                        @endif
                                        <h4 class="header-title">Add User</h4>
                                        <form method="post"   enctype="multipart/form-data"  action="{{route('users.store')}}">
                                        	 @csrf
              		
                                            <div class="form-group">
                                                <label for="exampleInputName">FirstName</label>
                                                <input id="firstName" type="text" required="required" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" placeholder="First Name" autocomplete="firstName" autofocus>  
                                                  @error('firstName')
                                                 <span class="text-danger">{{ $message }}</span>
                                                  </span>
                                                   @enderror   
                                            </div>
                                              <div class="form-group">
                                                <label for="exampleInputName">LastName</label>
                                                <input id="lastName" type="text" required="required" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" placeholder="Last Name" autocomplete="lastName" autofocus>  
                                                  @error('lastName')
                                                 <span class="text-danger">{{ $message }}</span>
                                                  </span>
                                                   @enderror   
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputOverview">Email Address</label>
                                             
                                               <input id="email" class="form-control" type="email" placeholder="Email Address" name="email" required="required">
                                                 @error('email')
                                               <span class="text-danger">{{ $message }}</span>
                                                  @endif
                                                  
                                            </div>      
                                            <div class="form-group">
                                              <label for="exampleInputrole">Role</label>

                                              <Select class="form-control" id="role" name="role">
                                                <option value="">Select Role</option>
                                                @foreach($role as $r)
                                                <option value="{{$r->id}}">{{$r->roles_name}}</option>
                                                @endforeach
                                              <Select>
                                                 @error('role')
                                               <span class="text-danger">{{ $message }}</span>
                                                  @endif
                                              
                                            </div>             
                                              
                                            <div class="form-group">
                                               <label for="exampleInputOverview">Password</label>
                                             
                                               <input class="form-control" type="password" placeholder="Password" name="password" required="required">
                                               @if ($errors->has('password'))
                                             <span class="text-danger">{{ $errors->first('password') }}</span>
                                             @endif
                                             </div>
                                              <div class="form-group">
                                               <label for="exampleInputOverview">Confirm Password</label>
                                             <input id="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                             @if ($errors->has('password_confirmation'))
                                             <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                             @endif
                                         </div>
                                                   
                  
                                          
                                           
                                            <button type="submit"  name="submit" class="btn btn-submit_new mt-4 pr-4 pl-4">Submit</button>
                                            <a class="btn btn-outline-green  mt-4 pr-4 pl-4" href="{{url('/users')}}">Back To List</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- basic form end -->
                            <!-- basic form start -->
                            
                         
          
                         
                            <!-- Custom file input start -->
                            
                        </div>
                    </div>
                                            
                            
<br>

 
@endsection