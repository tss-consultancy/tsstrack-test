@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Leave License Entry</h1>

    <form method="POST" action="{{ route('leave-license.update', $leave_license->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Enter Unit -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Unit *</label>
                <input type="text" name="unit" class="form-control" value="{{ old('unit', $leave_license->unit) }}" required>
                @error('unit')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Owner -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Owner *</label>
                <input type="text" name="owner" class="form-control" value="{{ old('owner', $leave_license->owner) }}" required>
                @error('owner')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Rent Amount -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Rent Amount *</label>
                <input type="number" name="rent_amount" class="form-control" value="{{ old('rent_amount', $leave_license->rent_amount) }}" required>
                @error('rent_amount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Deposit Amount -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Deposit Amount *</label>
                <input type="number" name="deposit_amount" class="form-control" value="{{ old('deposit_amount', $leave_license->deposit_amount) }}" required>
                @error('deposit_amount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter From Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter From Date *</label>
                <input type="date" name="from_date" class="form-control" value="{{ old('from_date', $leave_license->from_date) }}" required>
                @error('from_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter To Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter To Date *</label>
                <input type="date" name="to_date" class="form-control" value="{{ old('to_date', $leave_license->to_date) }}" required>
                @error('to_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Escalation Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Escalation Date *</label>
                <input type="date" name="escalation_date" class="form-control" value="{{ old('escalation_date', $leave_license->escalation_date) }}" required>
                @error('escalation_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Escalation Percentage -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Escalation (%) *</label>
                <input type="number" name="escalation_percentage" class="form-control" value="{{ old('escalation_percentage', $leave_license->escalation_percentage) }}" required>
                @error('escalation_percentage')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Date of Commitment -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Commitment Date *</label>
                <input type="date" name="commitment_date" class="form-control" value="{{ old('commitment_date', $leave_license->commitment_date) }}" required>
                @error('commitment_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Date of Contract -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Contract Date *</label>
                <input type="date" name="contract_date" class="form-control" value="{{ old('contract_date', $leave_license->contract_date) }}" required>
                @error('contract_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Remarks -->
            <div class="col-md-12 mb-3">
                <label class="form-label text-success">Enter Remarks</label>
                <textarea name="remarks" class="form-control">{{ old('remarks', $leave_license->remarks) }}</textarea>
                @error('remarks')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Upload PDF -->
            <div class="col-md-12 mb-3">
                <label class="form-label text-success">Upload PDF</label>
                <input type="file" name="pdf" class="form-control" accept="application/pdf">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Details</button>
    </form>
</div>
@endsection
