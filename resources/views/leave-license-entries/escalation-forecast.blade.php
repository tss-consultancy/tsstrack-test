{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Escalation Forecast Report</h1>

        <!-- Date Range Input Form -->
        <form action="{{ route('escalation.forecast') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="from_date">From Date:</label>
                    <input type="date" id="from_date" name="from_date" class="form-control" min="{{ date('d-m-Y') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="to_date">To Date:</label>
                    <input type="date" id="to_date" name="to_date" class="form-control" min="{{ date('d-m-Y') }}" required>
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Generate Report</button>
                </div>
            </div>
        </form>

        <!-- Display Results Table if Available -->
        @if(isset($forecasts) && $forecasts->count() > 0)
            <h3 class="mt-4">Escalation Forecast for: {{ $fromDate }} to {{ $toDate }}</h3>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Input Date Range</th>
                        <th>Properties</th>
                        <th>Escalation Amount</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($forecasts as $forecast)
                        <tr>
                            <td>{{ $fromDate }} - {{ $toDate }}</td>
                            <td>{{ $forecast->unit }}</td>
                            <td>{{ number_format($forecast->calculated_escalation, 2) }}</td>  <!-- Show only the calculated escalation amount -->
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Download Buttons -->
            <div class="mt-4">
                <a href="{{ route('escalation.forecast.download.excel') }}" class="btn btn-success">Download Excel</a>
                <a href="{{ route('escalation.forecast.download.pdf') }}" class="btn btn-danger">Download PDF</a>
            </div>

            <!-- Display Escalation Calculation for Selected Unit -->
            @if(isset($selectedForecast))
                <h4>Escalation Calculation</h4>
                <p><strong>Unit:</strong> {{ $selectedForecast->unit }}</p>
                <p><strong>Owner:</strong> {{ $selectedForecast->owner }}</p>
                <p><strong>From Date:</strong> {{ $fromDate }}</p>
                <p><strong>To Date:</strong> {{ $toDate }}</p>
                <p><strong>Months of Escalation:</strong> {{ $monthsOfEscalation }}</p>
                <p><strong>Escalation Amount:</strong> {{ number_format($selectedForecast->calculated_escalation, 2) }}</p>
                <p><strong>Total Amount:</strong> {{ number_format($selectedForecast->rent_amount + $selectedForecast->calculated_escalation, 2) }}</p>
            @endif

        @else
            <p>No forecast data available for the selected date range.</p>
        @endif
    </div>
@endsection --}}

{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Escalation Forecast Report</h1> --}}

    <!-- Date Range Input Form -->
    {{-- <form action="{{ route('escalation.forecast') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="from_date">From Date:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
                <label for="to_date">To Date:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Generate Report</button>
            </div>
        </div>
    </form>

    <!-- Display Results Table if Available -->
    @if(isset($forecasts) && $forecasts->count() > 0)
        <h3 class="mt-4">Escalation Forecast for: {{ $fromDate }} to {{ $toDate }}</h3>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Input Date Range</th>
                    <th>Properties</th>
                   
                    <th>Total Amount</th> <!-- New column for Total Amount -->
                </tr>
            </thead>
            <tbody>
                @foreach($forecasts as $forecast)
                    <tr>
                        <td>{{ $fromDate }} - {{ $toDate }}</td>
                        <td>{{ $forecast->unit }}</td>
                        <td>{{ number_format($forecast->calculated_escalation, 2) }}</td>  <!-- Show only the calculated escalation amount -->
                        <td>{{ number_format($forecast->rent_amount + $forecast->calculated_escalation, 2) }}</td> <!-- Calculate and display Total Amount -->
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Download Buttons -->
        <div class="mt-4">
            <a href="{{ route('escalation.forecast.download.excel') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('escalation.forecast.download.pdf') }}" class="btn btn-danger">Download PDF</a>
        </div>

        <!-- Display Escalation Calculation for Selected Unit -->
        @if(isset($selectedForecast))
            <h4>Escalation Calculation</h4>
            <p><strong>Unit:</strong> {{ $selectedForecast->unit }}</p>
            <p><strong>Owner:</strong> {{ $selectedForecast->owner }}</p>
            <p><strong>From Date:</strong> {{ $fromDate }}</p>
            <p><strong>To Date:</strong> {{ $toDate }}</p>
            <p><strong>Months of Escalation:</strong> {{ $monthsOfEscalation }}</p>
            <p><strong>Total Amount:</strong> {{ number_format($selectedForecast->rent_amount + $selectedForecast->calculated_escalation, 2) }}</p>
        @endif

    @else
        <p>No forecast data available for the selected date range.</p>
    @endif
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Escalation Forecast Report</h1>
    <hr>

    <!-- Date Range Input Form -->
    <form action="{{ route('escalation.forecast') }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="from_date">From Date:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
                <label for="to_date">To Date:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-block">Generate Report</button>
            </div>
        </div>
    </form>

    <!-- Display Results Table if Available -->
    @if(isset($forecasts) && $forecasts->count() > 0)
        <h3 class="mt-4 text-center">Escalation Forecast for: {{ $fromDate }} to {{ $toDate }}</h3>
        <table class="table table-striped mt-3 table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Input Date Range</th>
                    <th>Properties</th>
                    <th>Escalation Amount</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forecasts as $forecast)
                    <tr>
                        <td>{{ $fromDate }} - {{ $toDate }}</td>
                        <td>{{ $forecast->unit }}</td>
                        <td>{{ number_format($forecast->calculated_escalation, 2) }}</td>
                        <td>{{ number_format($forecast->rent_amount + $forecast->calculated_escalation, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Download Buttons -->
        <div class="mt-4 text-center">
            <a href="{{ route('escalation.forecast.download.excel') }}" class="btn btn-success mx-2">Download Excel</a>
            <a href="{{ route('escalation.forecast.download.pdf') }}" class="btn btn-danger mx-2">Download PDF</a>
        </div>

    @else
        <p class="text-center mt-3">No forecast data available for the selected date range.</p>
    @endif
</div>
@endsection
