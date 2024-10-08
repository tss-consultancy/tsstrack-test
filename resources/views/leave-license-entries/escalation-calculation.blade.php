@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Escalation Calculation</h1>

    <p>Unit: {{ $license->unit }}</p>
    <p>Owner: {{ $license->owner }}</p>
    <p>From Date: {{ $license->from_date }}</p>
    <p>To Date: {{ $license->to_date }}</p>
    <p>Months of Escalation: {{ $months }}</p>
    <p>Escalation Amount: {{ $escalationAmount }}</p> <!-- Display the escalation amount -->

    <!-- Additional calculations and logic here -->

    <div>
        <h3>Escalation Calculation</h3>
        <p>Rent Amount: {{ number_format($license->rent_amount, 2) }}</p>
        <p>Escalation Amount: {{ number_format($escalationAmount, 2) }}</p>
        <p>Total Amount: {{ number_format($totalAmount, 2) }}</p>
    </div>
    

</div>
@endsection
