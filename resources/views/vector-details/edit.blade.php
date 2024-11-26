@extends('vector-details.base')
@section('action-content')

<div class="container-fluid py-4 px-4">
    <div class="row bg-white rounded align-items-center justify-content-center mx-0 p-4 mt-4">
        <form action="{{route('vectordetails.save')}}" method="POST">
            @csrf
            <table class="table table-fixed text-start align-middle table-bordered mb-0">
                <tbody>
                    <tr class="table-info">
                        <td colspan="3" class="text-center">Update Vector Details
                          
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="col-4">
                            <strong># of Machine(s)</strong><br>
                            <input type="number" placeholder="# of Machines" name="machines" class="form-control" value="{{ old('machines', $vectordetails->machine ?? '') }}">
                            <input type="text" hidden name="customer_id" class="form-control" value="{{$user->id}}">
                        </td>
                        <td class="col-4">
                            <strong>Condition</strong><br>
                            <input type="text" placeholder="Condition" name="condition" class="form-control" value="{{ old('condition', $vectordetails->condition ?? '') }}">
                            
                        </td>
                        <td class="col-4">
                            <strong># of Needles</strong><br>
                            <input type="number" placeholder="# of Needles" name="needles" class="form-control" value="{{ old('needles', $vectordetails->needles ?? '') }}">
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="col-4">
                            <strong>Thread</strong><br>
                            <input type="text" placeholder="Thread" name="thread" class="form-control" value="{{ old('thread', $vectordetails->thread ?? '') }}">
                        </td>
                        <td class="col-4">
                            <strong>Needle Brand</strong><br>
                            <input type="text" placeholder="Needle Brand" name="needle_brand" class="form-control" value="{{ old('needle_brand', $vectordetails->needle_brand ?? '') }}">
                        </td>
                        <td class="col-4">
                            <strong>Backing (Pique / Jersey)</strong><br>
                            <input type="text" placeholder="Backing (Pique / Jersey)" name="backing_pique_jersey" class="form-control" value="{{ old('backing_pique_jersey', $vectordetails->backing_pique_jersey ?? '') }}">
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="col-4">
                            <strong>Brand</strong><br>
                            <input type="text" placeholder="Brand" name="brand" class="form-control" value="{{ old('brand') }}">
                        </td>
                        <td class="col-4">
                            <strong>Backing (Cotton / Twill)</strong><br>
                            <input type="text" placeholder="Backing (Cotton / Twill)" name="backing_cotton_twill" class="form-control" value="{{ old('backing_cotton_twill', $vectordetails->backing_cotton_twill ?? '') }}">
                        </td>
                        <td class="col-4">
                            <strong>Model</strong><br>
                            <input type="text" placeholder="Model" name="model" class="form-control"  value="{{ old('model', $vectordetails->model ?? '') }}">
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="col-4">
                      

                            <strong>Backing (Cap)</strong><br>
                            <input type="text" placeholder="Backing (Cap)" name="backing_cap" class="form-control"  value="{{ old('backing_cap', $vectordetails->backing_cap ?? '') }}">
                        </td>
                        <td class="col-4">
                            <strong>Needle Number</strong><br>
                            <input type="text" placeholder="Needle Number" name="needle_number" class="form-control"  value="{{ old('needle_number', $vectordetails->needle_number ?? '') }}">
                        </td>
                        <td class="col-4">
                            <strong># of Heads</strong><br>
                            <input type="number" placeholder="# of Heads" name="heads" class="form-control"   value="{{ old('heads', $vectordetails->head ?? '') }}">
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="col-4">
                            <strong>Comments</strong><br>
                            <textarea class="form-control" name="comments" placeholder="Write your comments here">{{ old('comments',$vectordetails->comment_box ?? '') }}</textarea>
                        </td>
                        <td >
                                    
                        </td>
                        <td>
                          
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

 
@endsection