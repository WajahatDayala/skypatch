<div class="bg-table rounded h-100 p-4 mt-4">
    <div class="row bg-dark p-2">
        <h6 class="text-light fw-light text-center mb-0">Job Information</h1>
    </div>
    <div class="row">
        <div class="col-7">
            <table class="table table-bordered">
                <tbody>
                    <tr class="row">
                        <td class="col-3">
                            <strong>Number</strong><br>
                            <span>OR-{{$order->order_id}}</span>
                        </td>
                        <td class="col-3">
                            <strong>Date & Time</strong><br>
                            <span>{{$order->received_date}}</span>
                        </td>
                        <td class="col-3">
                            <strong>Customer Nick</strong><br>
                            {{-- <span>{{$order->customer_name}}</span> --}}
                        </td>
                        <td class="col-3">
                            <strong>Desing Namw/PO</strong><br>
                            <span>{{$order->design_name}}</span>
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-3">
                            <strong>Height</strong><br>
                            <span>{{$order->height}}</span>
                        </td>
                        <td class="col-3">
                            <strong>Width</strong><br>
                            <span>{{$order->width}}</span>
                        </td>
                        <td class="col-3">
                            <strong>Required Format</strong><br>
                            <span>{{$order->format}}</span>
                        </td>
                        <td class="col-3">
                            <strong>Placement</strong><br>
                            <span>{{$order->placement}}</span>
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-3">
                            <strong>Number of Colors</strong><br>
                            <span>{{$order->number_of_colors}}</span>
                        </td>
                        <td class="col-3">
                            <strong>Fabric Type</strong><br>
                            <span>{{$order->fabric_name}}</span>
                        </td>
                        <td class="col-6">
                            <strong>Design Type</strong><br>
                            <span>{{$order->order_status_name}}</span>
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-12">
                            <strong>Customer Instructions</strong><br>
                            <span>{{ $orderInstruction ? $orderInstruction->instruction : 'No instruction available.' }}</span>
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="col-12">
                            <strong>Admin Instructions</strong><br>
                            <span>{{ $adminInstruction ? $adminInstruction->instruction : 'No instruction available.' }} </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-5">
            <form method="post" action="{{route('all-worker-orders.update',['all_worker_order'=>$order->order_id])}}">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->
            <table class="table table-bordered">
                                        
                <tbody>
                    
                    <tr class="row d-flex align-items-center justify-content-center">
                        
                    
                        <td class="col-2">
                            
                        </td>
                        <td class="col-5 text-center">
                           <b>Option A</b>
                        </td>
                        <td class="col-5 text-center">
                            <b>Option B</b>
                        </td>
                    </tr>
               
                    <tr class="row d-flex align-items-center justify-content-center">
                        
                    
                        <td class="col-2">
                            <input type="text" hidden name="order_id" value="{{$order->order_id}}">
                            Height
                        </td>
                        <td class="col-5">
                            <input type="number" name="height_A" class="form-control" id="inputEmail3" value="{{ old('height_A', $jobInfo->height_A ?? '') }}"  step="any">
                        </td>
                        <td class="col-5">
                            <input type="number" name="height_B" class="form-control" id="inputEmail3" value="{{$jobInfo->height_B ?? ''}}"  step="any">
                        </td>
                    </tr>
                    <tr class="row d-flex align-items-center justify-content-center">
                        <td class="col-2">
                            Width
                        </td>
                        <td class="col-5">
                            <input type="number" name="width_A" class="form-control" id="inputEmail3" value="{{ old('width_A', $jobInfo->width_A ?? '') }}"  step="any">
                        </td>
                        <td class="col-5">
                            <input type="number" name="width_B" class="form-control" id="inputEmail3" value="{{ old('width_B', $jobInfo->width_B ?? '') }}"  step="any">
                        </td>
                    </tr>
                    <tr class="row d-flex align-items-center justify-content-center">
                        <td class="col-2">
                            Stitches
                        </td>
                        <td class="col-5">
                            <input type="number" name="stitches_A" class="form-control" id="inputEmail3" value="{{ old('stitches_A', $jobInfo->stitches_A ?? '')}}">
                        </td>
                        <td class="col-5">
                            <input type="number" name="stitches_B" class="form-control" id="inputEmail3" value="{{ old('stitches_A',$jobInfo->stitches_B ?? '')}}">
                        </td>
                    </tr>
                    <tr class="row d-flex align-items-center justify-content-center">
                        <td style="display:none;" class="col-2">
                            Price
                        </td>
                        <td class="col-5">
                            <div class="input-group">
                                <span hidden class="input-group-text" id="basic-addon1">$</span>
                                <input type="number" hidden id="price_A" name="price_A" class="form-control" placeholder="Price"
                                    aria-label="Username" aria-describedby="basic-addon1" value="{{ old('price_A', $jobInfo->price_A ?? '')}}">
                            </div>
                        </td>
                        <td class="col-5">
                            <div class="input-group">
                                <span hidden class="input-group-text" id="basic-addon1">$</span>
                                <input type="number" id="price_B" hidden name="price_B" class="form-control" placeholder="Price"
                                    aria-label="Username" aria-describedby="basic-addon1" value="{{ old('price_B', $jobInfo->price_B ?? '')}}">
                            </div>
                        </td>
                    </tr>
                    <tr class="row d-flex align-items-center justify-content-center">
                        <td style="display:none;" class="col-2">
                            Total
                        </td>
                        <td class="col-5">
                            <input type="number" hidden class="form-control" id="total" name="total" readonly  value="{{ old('total',$jobInfo->total ?? '')}}">
                        </td>
                        <td class="col-5">
                            {{-- <input type="number" class="form-control" id="total_B" readonly> --}}
                            <button type="submit" class="btn btn-primary rounded-pill">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        </div>
    </div>
    
</div>

<script>
    // Get elements
 const priceA = document.getElementById('price_A');
 const priceB = document.getElementById('price_B');
 const totalA = document.getElementById('total');
 // const totalB = document.getElementById('total_B');  // Uncomment if you want another total B
 
 // Function to update total
 function updateTotal() {
     // Get values of priceA and priceB, and convert them to numbers
     const valueA = parseFloat(priceA.value) || 0;  // If input is empty or invalid, default to 0
     const valueB = parseFloat(priceB.value) || 0;  // If input is empty or invalid, default to 0
 
     // Set totalA to the sum of priceA and priceB
     totalA.value = valueA + valueB;
 }
 
 // Add event listeners to update totals when prices change
 priceA.addEventListener('input', updateTotal);
 priceB.addEventListener('input', updateTotal);
 </script>