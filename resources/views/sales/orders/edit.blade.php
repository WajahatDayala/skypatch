@extends('sales.orders.base')
@section('action-content')

<div class=" container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Order OR-{{$order->order_id}}</h6> 
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
                 <form action="{{ route('support-allorders.update', $order->order_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Name/PO *</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$order->design_name}}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                         @enderror   
                        </div>
                        <input hidden type="text" name="desc" class="form-control" value="{{$order->description}}">
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Required Format
                            *</label>
                        <div class="col-sm-8">
                            <select class="form-select @error('required_format_id') is-invalid @enderror" name="required_format_id" aria-label="Default select example">
                                <option value="" selected class='text-gray'>Select Format</option>
                                @foreach($requiredFormat as $f)
                                <option value="{{ $f->id }}" 
                                {{ $order->format == $f->name ? 'selected' : '' }}>
                                 {{ $f->name }}
                                </option>
                                @endforeach
                              
                            </select>
                            @error('required_format_id')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                             @enderror   
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Height</label>
                        <div class="col-sm-8">
                            <input type="text" name="height" class="form-control" id="inputEmail3" value="{{$order->height}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Width</label>
                        <div class="col-sm-8">
                            <input type="text" name="width" class="form-control" id="inputEmail3" value="{{$order->width}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Fabric
                            *</label>
                        <div class="col-sm-8">
                            <select class="form-select @error('fabric_id') is-invalid @enderror" name="fabric_id" aria-label="Default select example">
                                <option value="" selected class='text-gray'>Select Fabric</option>
                                @foreach($fabric as $f)
                                <option value="{{$f->id}}" {{ $order->fabric_name == $f->name ? 'selected' : '' }}>{{$f->name}}</option>
                                @endforeach
                            </select>
                            @error('fabric_id')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                             @enderror   
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Placement
                            *</label>
                        <div class="col-sm-8">
                            <select class="form-select @error('placement_id') is-invalid @enderror" name="placement_id" aria-label="Default select example">
                                <option value="" selected class='text-gray'>Select Placement</option>
                                @foreach($placement as $p)
                                <option value="{{$p->id}}" {{ $order->placement == $p->name ? 'selected' : '' }}>{{$p->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="status" value="2">

                            @error('placement_id')
                            <span class="text-danger">{{ $message }}</span>
                            </span>
                             @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Number of
                            Colors</label>
                        <div class="col-sm-8">
                            <input type="text" name="number_of_colors" class="form-control" id="inputPassword3" value="{{$order->number_of_colors}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Additional
                            Instruction</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="additional_instruction" placeholder="Leave a comment here"
                                id="floatingTextarea" style="height: 150px;">{{$orderInstruction? $orderInstruction->instruction:''}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Select
                            Files</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="files[]" type="file" id="formFileMultiple" multiple>
                        </div>
                        
                        <!--read files-->
                        @foreach($quoteFiles as $f)
                        <input type="hidden" name="read_files" value="{{$f->files}}"/>
                        @endforeach
                    

                    </div>
                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-4 pt-0 text-end">Super Urgent</legend>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" name="super_urgent"  type="checkbox" id="gridCheck1"
                                value="1" {{ old('super_urgent', $order->super_urgent ?? 1) ? 'checked' : '' }}>
                                
                                <label class="form-check-label" for="gridCheck1">
                                    Let us know if your order is super urgent!
                                </label>
                            </div>
                        </div>
                    </div>

                   

                    <input type="hidden" name="customer_id" value="{{$order->customer_id}}">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary">Update Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




 
@endsection