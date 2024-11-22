@extends('price-details.base')
@section('action-content')


<div class=" container-fluid py-4 px-4">
              
                <div class="row bg-light rounded align-items-center justify-content-center mx-0 p-4 mt-4">
       
                    <table class="table table-fixed text-start align-middle table-bordered mb-0">
                        <tbody>
                            <tr class="table-info">
                                <td colspan="3" class="text-center">Pricing Details</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Minimum Price</strong><br>
                                    <input type="number" placeholder="Minimum Price Here" name="mini_price" class="form-control">
                                </td>
                                <td class="col-4">
                                    <strong>Maximum Price</strong><br>
                                    <input type="number" placeholder="Maximum Price Here" name="max_price" class="form-control">
                                </td>
                                <td class="col-4">
                                    <strong>1000 Stitches</strong><br>
                                    <input type="number" placeholder="Stitches" name="stitches" class="form-control">
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Normal Delivery</strong><br>
                                    <select class="form-control" name="delivery_type">
                                        <option value="1">Normal Delivery</option>
                                        <option value="2">Super Urgent</option>
                                    </select>
                                </td>
                                <td class="col-4">
                                    <strong>Editing/Changes</strong><br>
                                    <input type="text" placeholder="Editing OR Changes" name="editing_changes" class="form-control">
                                </td>
                                <td class="col-4">
                                    <strong>Editing in stitches file</strong><br>
                                    <input type="text" placeholder="Editing in Stitches file" name="editing_stitches_file" class="form-control">
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Comment Box 1</strong><br>
                                   <textarea class="form-control" name="comment_1" placeholder="Wrting Something"></textarea>
                                </td>
                                <td class="col-4">
                                    <strong>Comment Box 2</strong><br>
                                    <textarea class="form-control" name="comment_2" placeholder="Wrting Something"></textarea>
                                </td>
                                <td class="col-4">
                                    <strong>Comment Box 3</strong><br>
                                    <textarea class="form-control" name="comment_3" placeholder="Wrting Something"></textarea>
                                </td>
                            </tr>

                            <tr class="bg-white">
                                <td class="col-4">
                                    <strong>Comment Box 4</strong><br>
                                   <textarea class="form-control" name="comment_4" placeholder="Wrting Something"></textarea>
                                </td>
                                <td >
                                    
                                </td>
                                <td >
                                  
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            
</div>
 
 
@endsection