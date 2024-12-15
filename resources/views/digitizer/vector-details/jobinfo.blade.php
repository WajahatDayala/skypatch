<div class="bg-table rounded h-100 p-4 mt-4">
    <div class="row bg-dark p-2">
        <h6 class="text-light fw-light text-center mb-0">Job Information</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                    <tr class="row">
                        <td class="col-3">
                            <strong>Number</strong><br>
                            <span>VO-{{$order->order_id}}</span>
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
   
    </div>
</div>