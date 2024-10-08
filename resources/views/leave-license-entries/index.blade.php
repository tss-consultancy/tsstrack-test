@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4" style="font-size: 1.8rem;">Leave License Entries</h1>
    <div class="mb-3">
        <a href="{{ url('leave-license/create') }}" class="btn btn-primary">Add Leave License Entry</a>
        <a href="{{ route('leave-license.download') }}" class="btn btn-success">Download CSV</a>
        <a href="{{ route('escalation.forecast') }}" class="btn btn-dark">Escalation Forecast Report</a>
    </div>

    @if (session('added'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('added') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="table-wrapper table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-light">
                                <tr>
                                    <th><h6><strong>Sr No</strong></h6></th>
                                    <th><h6><strong>Unit</strong></h6></th>
                                    <th><h6><strong>Owner</strong></h6></th>
                                    <th><h6><strong>Rent</strong></h6></th>
                                    <th><h6><strong>Deposit</strong></h6></th>
                                    <th><h6><strong>From Date</strong></h6></th>
                                    <th><h6><strong>To Date</strong></h6></th>
                                    <th><h6><strong>Escalation Date</strong></h6></th>
                                    <th><h6><strong>Escalation (%)</strong></h6></th>
                                    <th><h6><strong>Escalation Amount</strong></h6></th>
                                    <th><h6><strong>Actions</strong></h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $inc = 1; ?>
                                @foreach ($leaveLicenses as $license) 
                                    <tr>
                                        <td>{{ $inc++ }}</td>
                                        <td>{{ $license->unit }}</td>
                                        <td>{{ $license->owner }}</td>
                                        <td>{{ number_format($license->rent_amount, 2) }}</td>
                                        <td>{{ number_format($license->deposit_amount, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($license->from_date)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($license->to_date)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($license->escalation_date)->format('d-m-Y') }}</td>
                                        <td>{{ $license->escalation_percentage }}%</td>
                                        <td>
                                            <?php 
                                            $escalationAmount = $license->rent_amount * ($license->escalation_percentage / 100);
                                            echo number_format($escalationAmount + $license->rent_amount, 2);
                                            ?>
                                        </td>
                                        <td>
                                            <div class="action d-flex justify-content-between align-items-center">
                                                <a href="{{ route('leave-license.edit', $license->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('leave-license.destroy', $license->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
    
                                                <a href="{{ route('leave-license.calculate-escalation', $license->id) }}" class="btn btn-success btn-sm me-1" title="Calculate Escalation">
                                                    <i class="fas fa-calculator"></i>
                                                </a>
    
                                                <a href="{{ route('leave-license.show', $license->id) }}" class="btn btn-info btn-sm" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="summary mt-4">
                        <h2>Summary</h2>
                        <p><strong>Total Rent Amount:</strong> {{ number_format($totalRent, 2) }}</p>
                        <p><strong>Total Deposit Amount:</strong> {{ number_format($totalDeposit, 2) }}</p>
                        <p><strong>Total Escalation Amount:</strong> {{ number_format($totalEscalation, 2) }}</p>
                        <p><strong>Projected Rent Amount (After {{ $years }} Years):</strong> {{ number_format($futureRentAmount, 2) }}</p>
                        <p><strong>Total Rent After {{ $years }} Years:</strong> {{ number_format($totalRentAfterYears, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
