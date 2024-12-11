@extends('reports.base')
@section('action-content')

<div class="container-fluid py-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Sales Annum</h6>
                    </div>
                </div>
                     
                <form action="{{ route('sales-annum.result') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control" name="from_date" id="from_date">
                                    @foreach(range(date('Y'), date('Y') + 10) as $yearOption)
                                        <option value="{{ $yearOption }}" @if($yearOption == $year) selected @endif>
                                            {{ $yearOption }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="dataTable" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">Customer Name</th>
                                @foreach($months as $month)
                                    <th class="text-center">{{ $month }}</th>
                                @endforeach
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordersData as $order)
                                <tr>
                                    <td class="text-center">{{ $order->customer_name }}</td>
                                    @php
                                        $totalForRow = 0;
                                    @endphp
                                    @foreach($months as $month)
                                        <td class="text-center">
                                            @php
                                                $monthKey = ucfirst(strtolower($month));  // Capitalize first letter to match the DB column name
                                                $value = $order->$monthKey ?? 0;
                                                $totalForRow += $value; // Add month value to row total
                                            @endphp
                                            {{ $value }}
                                        </td>
                                    @endforeach
                                    <td class="text-center">{{ $totalForRow }}</td> <!-- Row total calculated -->
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">Total</th>
                                @foreach($months as $month)
                                    <th class="text-center">
                                        @php
                                            $monthKey = ucfirst(strtolower($month));
                                            $totalForMonth = $ordersData->sum(function($order) use ($monthKey) {
                                                return $order->$monthKey ?? 0;
                                            });
                                        @endphp
                                        {{ $totalForMonth }}
                                    </th>
                                @endforeach
                                <th class="text-center">
                                    @php
                                        $totalOverall = $ordersData->sum('total_sales');
                                    @endphp
                                    {{ $totalOverall }}
                                </th> <!-- Grand total -->
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
