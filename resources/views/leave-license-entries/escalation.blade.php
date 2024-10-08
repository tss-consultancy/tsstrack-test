@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Escalation Calculation for {{ $license->unit }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Unit: {{ $license->unit }}</h5>
            <p class="card-text"><strong>Owner:</strong> {{ $license->owner }}</p>
            <p class="card-text"><strong>Rent Amount:</strong> ₹{{ number_format($license->rent_amount, 2) }}</p>
            <p class="card-text"><strong>Deposit Amount:</strong> ₹{{ number_format($license->deposit_amount, 2) }}</p>
            <p class="card-text"><strong>From Date:</strong> {{ \Carbon\Carbon::parse($license->from_date)->format('d/m/Y') }}</p>
            <p class="card-text"><strong>To Date:</strong> {{ \Carbon\Carbon::parse($license->to_date)->format('d/m/Y') }}</p>
            <p class="card-text"><strong>Escalation Date:</strong> {{ \Carbon\Carbon::parse($license->escalation_date)->format('d/m/Y') }}</p>
            <p class="card-text"><strong>Escalation (%):</strong> {{ $license->escalation_percentage }}%</p>
            <p class="card-text"><strong>Months of Escalation:</strong> {{ $months }}</p>
            
            {{-- Calculation for Escalation Amount --}}
            @php
                $escalationAmount = $license->rent_amount * ($license->escalation_percentage / 100) * $months;
                $totalAmount = $license->rent_amount + $escalationAmount;
            @endphp
            
            <p class="card-text"><strong>Escalation Amount:</strong> ₹{{ number_format($escalationAmount, 2) }}</p>
            <p class="card-text"><strong>Total Amount:</strong> ₹{{ number_format($totalAmount, 2) }}</p>

            <div class="mt-4">
                <a href="{{ route('leave-license.index') }}" class="btn btn-primary">Back to Index</a>
            </div>
        </div>
    </div>
</div>
@endsection
