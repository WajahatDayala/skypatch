<table class="table table-bordered">
    <tbody>
        <tr class="row">
            <td class="col-3">
                <strong>Number</strong><br>
                <span>QT-{{$quote->quote_id}}</span>
                <input type="text" hidden name="quote_id" value="{{$quote->quote_id}}">
            </td>
            <td class="col-3">
                <strong>Date & Time</strong><br>
                <span>{{$quote->received_date}}</span>
            </td>
            <td class="col-3">
                <strong>Customer Nick</strong><br>
                <span>{{$quote->customer_name}}</span>
            </td>
            <td class="col-3">
                <strong>Desing Namw/PO</strong><br>
                <span>{{$quote->design_name}}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-3">
                <strong>Height</strong><br>
                <span>{{$quote->height}}</span>
            </td>
            <td class="col-3">
                <strong>Width</strong><br>
                <span>{{$quote->width}}</span>
            </td>
            <td class="col-3">
                <strong>Required Format</strong><br>
                <span>{{$quote->format}}</span>
            </td>
            <td class="col-3">
                <strong>Placement</strong><br>
                <span>{{$quote->placement}}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-3">
                <strong>Number of Colors</strong><br>
                <span>{{$quote->number_of_colors}}</span>
            </td>
            <td class="col-3">
                <strong>Fabric Type</strong><br>
                <span>{{$quote->fabric_name}}</span>
            </td>
            <td class="col-6">
                <strong>Design Type</strong><br>
                <span>{{$quote->order_status_name}}</span>
            </td>
        </tr>
        <tr class="row">
            <td class="col-12">
                <strong>Customer Instructions</strong><br>
                <span>{{ $quoteInstruction ? $quoteInstruction->instruction : 'No instruction available.' }}</span>
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