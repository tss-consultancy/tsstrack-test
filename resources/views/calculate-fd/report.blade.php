@extends('layouts.app')

@section('content')
<div class="pe-3">
    <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="{{url('/fd-modules/index')}}">FD Modules</a>
                </li>

            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>FD Interest Calculation Report</h1>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card-style settings-card-2 mb-30">
            <h3 class="mb-3">Interest Report</h3>

            @if (count($fdDetails) > 0)
            <table id="fd-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>FD Number</th>
                        <th>Amount</th>
                        <th>Interest Rate (%)</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Days</th>
                        <th>Interest Earned</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fdDetails as $detail)
                    <tr>
                        <td>{{ $detail['fd_number'] }}</td>
                        <td>{{ number_format($detail['amount']) }}</td>
                        <td>{{ number_format($detail['rate'], 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($detail['start_date'])->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($detail['end_date'])->format('d-m-Y') }}</td>
                        <td>{{ $detail['days'] }}</td>
                        <td>{{ number_format($detail['interest'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


            <h4 class="mt-4">Total Interest Earned: {{ number_format($totalInterest, 2) }}</h4>
            @else
            <p>No FD details available.</p>
            @endif


        </div>
    </div>
</div>

@endsection