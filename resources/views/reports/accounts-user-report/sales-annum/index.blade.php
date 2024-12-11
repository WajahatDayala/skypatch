@extends('reports.base')

@section('action-content')

<!-- All Content Goes inside this div -->
<div class="container-fluid py-4 px-4">
    <div class="row g-4 d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-6 d-flex justify-content-start align-items-center">
                        <h6 class="h6 mb-0">Sales Annum</h6>
                    </div>
                </div>

                <!-- Search Form -->
                <form action="{{ route('sales-annum.result') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Year</label>
                                <!-- Year Selection Dropdown -->
                                <select class="form-control" required name="from_date" id="from_date">
                                    <!-- Year options will be populated here -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary rounded-lg m-4" name="btn-search">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script for Year Dropdown -->
<script>
    var currentYear = new Date().getFullYear();
    var futureYear = currentYear + 10;  // You can adjust this to the desired number of future years

    var yearSelect = document.querySelector('#from_date');

    // Get the selected year from the query parameters (if any)
    var selectedYear = new URLSearchParams(window.location.search).get('from_date') || currentYear;

    // Populate the select box with years
    for (var year = currentYear; year <= futureYear; year++) {
        var option = document.createElement('option');
        option.value = year;
        option.textContent = year;

        // Pre-select the year based on the request or default to the current year
        if (year == selectedYear) {
            option.selected = true;
        }

        yearSelect.appendChild(option);
    }
</script>

@endsection
