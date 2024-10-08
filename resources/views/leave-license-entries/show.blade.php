@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Leave License Entry Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Unit: {{ $leaveLicenseEntry->unit }}</h5>
            <p class="card-text"><strong>Owner:</strong> {{ $leaveLicenseEntry->owner }}</p>
            <p class="card-text"><strong>Rent Amount:</strong> {{ $leaveLicenseEntry->rent_amount }}</p>
            <p class="card-text"><strong>Deposit Amount:</strong> {{ $leaveLicenseEntry->deposit_amount }}</p>
            <p class="card-text"><strong>From Date:</strong> {{ $leaveLicenseEntry->from_date }}</p>
            <p class="card-text"><strong>To Date:</strong> {{ $leaveLicenseEntry->to_date }}</p>
            <p class="card-text"><strong>Escalation Date:</strong> {{ $leaveLicenseEntry->escalation_date }}</p>
            <p class="card-text"><strong>Escalation (%):</strong> {{ $leaveLicenseEntry->escalation_percentage }}</p>
            <p class="card-text"><strong>Date of Commitment:</strong> {{ $leaveLicenseEntry->commitment_date }}</p>
            <p class="card-text"><strong>Date of Contract:</strong> {{ $leaveLicenseEntry->contract_date }}</p>
            <p class="card-text"><strong>Remarks:</strong> {{ $leaveLicenseEntry->remarks }}</p>

            <a href="{{ route('leave-license-entries.index') }}" class="btn btn-primary">Back to Index</a>
        </div>
    </div>
</div>

    <div class="container">
        <h1>Leave License Entry Details</h1>
        {{-- Calculation for Escalation Amount --}}

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Unit: {{ $leaveLicenseEntry->unit }}</h5>
                <p class="card-text"><strong>Maalik:</strong> {{ $leaveLicenseEntry->owner }}</p>
                <p class="card-text"><strong>Rent Amount:</strong> {{ $leaveLicenseEntry->rent_amount }}</p>
                <p class="card-text"><strong>Deposit Amount:</strong> {{ $leaveLicenseEntry->deposit_amount }}</p>
                <p class="card-text"><strong>From Date:</strong> {{ $leaveLicenseEntry->from_date }}</p>
                <p class="card-text"><strong>To Date:</strong> {{ $leaveLicenseEntry->to_date }}</p>
                <p class="card-text"><strong>Escalation Date:</strong> {{ $leaveLicenseEntry->escalation_date }}</p>
                <p class="card-text"><strong>Escalation (%):</strong> {{ $leaveLicenseEntry->escalation_percentage }}</p>
                <p class="card-text"><strong>Date of Commitment:</strong> {{ $leaveLicenseEntry->commitment_date }}</p>
                <p class="card-text"><strong>Date of Contract:</strong> {{ $leaveLicenseEntry->contract_date }}</p>
                <p class="card-text"><strong>Remarks:</strong> {{ $leaveLicenseEntry->remarks }}</p>

                <a href="{{ route('leave-license-entries.index') }}" class="btn btn-primary">Back to Index</a>
            </div>
        </div>
    </div>

@endsection
