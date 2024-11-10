@extends('admin.customers.invoice.base')
@section('action-content')



<!-- Blank Start -->



<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex flex-column align-items-start justify-content-between mb-4">
                    <h6 class="mb-0">All Invoices</h6>

                </div>
                <!-- <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 "></div>
                    <div class="col-lg-4"><a style="color:#fff; margin-left:70%;"
                            class="btn btn-rounded btn-primary mb-3" href="{{url('customer/orders/create')}}"><i
                                class="fa fa-plus">Add New</i></a></div>
                </div> -->
                <!-- <div class="row d-flex">
                  <div class="col-6">
                    <form action="">
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Show: </label>
                        <div class="w-50">
                          <select class="form-select mb-3" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-6 mb-4 d-flex justify-content-end">
                    <form class="d-flex align-items-center justify-content-end">
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label me-3">Search: </label>
                        <div class="w-75">
                          <input type="text" class="form-control" id="search">
                        </div>
                      </div>
                    </form>
                  </div>
                </div> -->
                <div class="table-responsive">
                    <table id="dataTable" class="table  text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col"> Sr# </th>
                                <th scope="col"> Invoice# </th>
                                <th scope="col"> Generated On </th>
                                <th scope="col"> Paid On </th>
                                <th scope="col"> Amount </th>
                                <th scope="col"> Status </th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $i)

                            <tr class="">

                                <td>{{ $loop->iteration }}</td>


                                <td>{{$i->invoiceNumber}}</td>




                                <td>{{$i->createdAt}}
                                </td>

                                <td>{{$i->paid_on ? $i->paid_on : 'N/A'}}</td>
                                <td>{{$i->total_amount ? $i->total_amount : 0}}</td>


                                <td>
                                    @if($i->paymentStatus === 1)
                                    <!-- Assuming 1 means Paid -->
                                    <span>Paid</span>
                                    @elseif($i->paymentStatus === 0)
                                    <!-- Assuming 0 means Unpaid -->
                                    <span>Payable</span>
                                    @elseif($i->vectorPaymentStatus === 1)
                                    <!-- Check vector payment status if no order status -->
                                    <span>Paid</span>
                                    @elseif($i->vectorPaymentStatus === 0)
                                    <span>Payable</span>
                                    @else
                                    <span>N/A</span>
                                    <!-- In case neither paymentStatus nor vectorPaymentStatus are available -->
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-sm btn-dark rounded-pill " href="{{ route('invoice.download', $i->invoice_id) }}">Download</a>
                                    <a class="btn btn-sm btn-danger rounded-pill" href="">Payable</a>
                                </td>
                            </tr>
                            @endforeach






                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    </div>
</div>
<!-- Blank End -->
<script>
  document.getElementById('downloadBtn').addEventListener('click', function(event) {
    event.preventDefault();  // Prevent the default link behavior (optional)

    // Get the download URL from the button's href attribute
    const downloadUrl = this.href;

    // Create a link element to programmatically trigger the download
    const link = document.createElement('a');
    link.href = downloadUrl;
    link.download = 'invoice.pdf';  // You can specify the filename here
    link.target = '_blank';  // Optionally open in a new tab

    // Programmatically click the link to trigger the download
    link.click();
});

</script>

@endsection