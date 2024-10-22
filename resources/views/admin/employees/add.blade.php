@extends('admin.customers.base')
@section('action-content')


<div class=" container-fluid py-4 px-4">

<h6 class="mb-4">Add Employee</h6>
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Employee Details</h6>
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
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                    <!-- Email Address 1 -->
                    <label for="inputEmail" class="col-sm-4 col-form-label text-end">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                    <!-- username  -->
                    <label for="Username" class="col-sm-4 col-form-label text-end">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                id="Username">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                    <!-- password  -->
                    <label for="password" class="col-sm-4 col-form-label text-end">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control @error('Password') is-invalid @enderror"
                                id="password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                            @enderror
                        </div>
                    </div>
               
                  





                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Role
                            *</label>
                        <div class="col-sm-8">
                            <select class="form-select @error('role_id') is-invalid @enderror" name="role_id"
                                aria-label="Default select example">
                                <option value="" selected class='text-gray'>Select Role</option>
                                @foreach($roles as $r)
                                <option value="{{$r->id}}">{{$r->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="status" value="2">

                            @error('role_id')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                            @enderror
                        </div>
                    </div>




                    <div class="row mb-3">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection