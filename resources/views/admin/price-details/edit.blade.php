@extends('admin.price-details.base')
@section('action-content')


<div class=" container-fluid py-4 px-4">
              
                <div class="row bg-white rounded align-items-center justify-content-center mx-0 p-4 mt-4">
       
                    <form action="{{ route('adminpricing.save') }}" method="POST">
                        @csrf
                    <table class="table table-fixed text-start align-middle table-bordered mb-0">
                        <tbody>
                            <tr class="table-info">
                                <td colspan="3" class="text-center">Update Pricing Criteria</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Minimum Price</strong><br>
                                    <input type="number" placeholder="Minimum Price Here" name="mini_price" class="form-control" value="{{ old('mini_price', $pricing->minimum_price ?? '') }}">
                                    <input type="text" hidden name="customer_id" class="form-control" value="{{$user->id}}">
                                </td>
                                <td class="col-4">
                                    <strong>Maximum Price</strong><br>
                                    <input type="number" placeholder="Maximum Price Here" name="max_price" class="form-control"  value="{{ old('max_price', $pricing->maximum_price ?? '') }}">
                                </td>
                                <td class="col-4">
                                    <strong>1000 Stitches</strong><br>
                                    <input type="number" placeholder="Stitches" name="stitches" class="form-control" value="{{ old('stitches', $pricing->stitches ?? '') }}">
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Normal Delivery</strong><br>
                                    <select class="form-control" name="delivery_type_id">
                                        <option value="1" {{ old('delivery_type', optional($pricing)->delivery_type_id) == 1 ? 'selected' : '' }}>Normal Delivery</option>
                                        <option value="2" {{ old('delivery_type', optional($pricing)->delivery_type_id) == 2 ? 'selected' : '' }}>Super Urgent</option>
                                    </select>
                                </td>
                                <td class="col-4">
                                    <strong>Editing/Changes</strong><br>
                                    <input type="text" placeholder="Editing OR Changes" name="editing_changes" class="form-control" value="{{ old('editing_changes', $pricing->editing_changes ?? '') }}">
                                </td>
                                <td class="col-4">
                                    <strong>Editing in stitches file</strong><br>
                                    <input type="text" placeholder="Editing in Stitches file" name="editing_stitches_file" class="form-control" value="{{ old('editing_stitches_file', $pricing->editing_in_stitch_file ?? '') }}">
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Comment Box 1</strong><br>
                                   <textarea class="form-control" name="comment_1" placeholder="Wrting Something">{{ old('comment_1', $pricing->comment_box_1 ?? '') }}</textarea>
                                </td>
                                <td class="col-4">
                                    <strong>Comment Box 2</strong><br>
                                    <textarea class="form-control" name="comment_2" placeholder="Wrting Something">{{ old('comment_2', $pricing->comment_box_2 ?? '') }}</textarea>
                                </td>
                                <td class="col-4">
                                    <strong>Comment Box 3</strong><br>
                                    <textarea class="form-control" name="comment_3" placeholder="Wrting Something">{{ old('comment_3', $pricing->comment_box_3 ?? '') }}</textarea>
                                </td>
                            </tr>

                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Comment Box 4</strong><br>
                                   <textarea class="form-control" name="comment_4" placeholder="Wrting Something">{{ old('comment_4', $pricing->comment_box_4 ?? '') }}</textarea>
                                </td>
                                <td >
                                    
                                </td>
                                <td>
                                  
                                </td>
                            </tr>

                                <td>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </td>
                            
                            
                        </tbody>
                    </table>
                </div>
              
                </form>

            
</div>
 
 
@endsection