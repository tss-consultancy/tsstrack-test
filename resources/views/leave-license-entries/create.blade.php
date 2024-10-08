{{-- @extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h1>Leave License Entry</h1>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card-style settings-card-2 mb-30">
                <form action="{{ url('leave-license-entry/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Enter Unit -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Unit *</label>
                            <input type="text" name="unit" placeholder="Enter Unit"
                                value="{{ old('unit') }}" />
                            <span class="text-danger">
                                @error('unit')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Owner -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Owner *</label>
                            <input type="text" name="owner" placeholder="Enter Owner"
                                value="{{ old('owner') }}" />
                            <span class="text-danger">
                                @error('owner')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Rent Amount -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Rent Amount *</label>
                            <input type="text" name="rent_amount" placeholder="Enter Rent Amount"
                                value="{{ old('rent_amount') }}" />
                            <span class="text-danger">
                                @error('rent_amount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Deposit Amount -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Deposit Amount *</label>
                            <input type="text" name="deposit_amount" placeholder="Enter Deposit Amount"
                                value="{{ old('deposit_amount') }}" />
                            <span class="text-danger">
                                @error('deposit_amount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter From Date -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter From Date *</label>
                            <input type="date" name="from_date" placeholder="dd-mm-yyyy"
                                value="{{ old('from_date') }}" />
                            <span class="text-danger">
                                @error('from_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter To Date -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter To Date *</label>
                            <input type="date" name="to_date" placeholder="dd-mm-yyyy"
                                value="{{ old('to_date') }}" />
                            <span class="text-danger">
                                @error('to_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Escalation Date -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Escalation Date *</label>
                            <input type="date" name="escalation_date" placeholder="dd-mm-yyyy"
                                value="{{ old('escalation_date') }}" />
                            <span class="text-danger">
                                @error('escalation_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Escalation Percentage -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Escalation (%) *</label>
                            <input type="text" name="escalation_percentage" placeholder="Enter Escalation (%)"
                                value="{{ old('escalation_percentage') }}" />
                            <span class="text-danger">
                                @error('escalation_percentage')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Date of Commitment -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Date of Commitment *</label>
                            <input type="date" name="commitment_date" placeholder="dd-mm-yyyy"
                                value="{{ old('commitment_date') }}" />
                            <span class="text-danger">
                                @error('commitment_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Date of Contract -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Date of Contract *</label>
                            <input type="date" name="contract_date" placeholder="dd-mm-yyyy"
                                value="{{ old('contract_date') }}" />
                            <span class="text-danger">
                                @error('contract_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Enter Remarks -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Remarks</label>
                            <textarea name="remarks" placeholder="Enter Remarks">{{ old('remarks') }}</textarea>
                            <span class="text-danger">
                                @error('remarks')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover" name="submit">
                            Add Leave License Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection --}}

{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Leave License Entry</h1>

    <form action="{{ route('leave-license.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Enter Unit *</label>
            <input type="text" name="unit" class="form-control" placeholder="Enter Unit" required>
            @error('unit')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Owner *</label>
            <input type="text" name="owner" class="form-control" placeholder="Enter Owner" required>
            @error('owner')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Rent Amount *</label>
            <input type="number" name="rent_amount" class="form-control" placeholder="Enter Rent Amount" required>
            @error('rent_amount')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Deposit Amount *</label>
            <input type="number" name="deposit_amount" class="form-control" placeholder="Enter Deposit Amount" required>
            @error('deposit_amount')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter From Date *</label>
            <input type="date" name="from_date" class="form-control" required>
            @error('from_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter To Date *</label>
            <input type="date" name="to_date" class="form-control" required>
            @error('to_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Escalation Date *</label>
            <input type="date" name="escalation_date" class="form-control" required>
            @error('escalation_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Escalation (%) *</label>
            <input type="number" name="escalation_percentage" class="form-control" placeholder="Enter Escalation (%)" required>
            @error('escalation_percentage')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Date of Commitment *</label>
            <input type="date" name="commitment_date" class="form-control" required>
            @error('commitment_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Date of Contract *</label>
            <input type="date" name="contract_date" class="form-control" required>
            @error('contract_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Enter Remarks</label>
            <textarea name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
            @error('remarks')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <form action="{{ route('leave-license.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Other fields -->
            <div class="form-group">
                <label>Upload PDF</label>
                <input type="file" name="pdf" class="form-control" accept="application/pdf">
            </div>
            <button type="submit" class="btn btn-primary">Store</button>
            <hr>
        </form>
        

        <button type="submit" class="btn btn-success">Add Details</button>
    </form>
</div>


@endsection --}}

{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Leave License Entry</h1>

    <form action="{{ route('leave-license.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Enter Unit -->
        <div class="form-group">
            <label>Enter Unit *</label>
            <input type="text" name="unit" class="form-control" placeholder="Enter Unit" required>
            @error('unit')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Owner -->
        <div class="form-group">
            <label>Enter Owner *</label>
            <input type="text" name="owner" class="form-control" placeholder="Enter Owner" required>
            @error('owner')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Rent Amount -->
        <div class="form-group">
            <label>Enter Rent Amount *</label>
            <input type="number" name="rent_amount" class="form-control" placeholder="Enter Rent Amount" required>
            @error('rent_amount')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Deposit Amount -->
        <div class="form-group">
            <label>Enter Deposit Amount *</label>
            <input type="number" name="deposit_amount" class="form-control" placeholder="Enter Deposit Amount" required>
            @error('deposit_amount')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter From Date -->
        <div class="form-group">
            <label>Enter From Date *</label>
            <input type="date" name="from_date" class="form-control" required>
            @error('from_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter To Date -->
        <div class="form-group">
            <label>Enter To Date *</label>
            <input type="date" name="to_date" class="form-control" required>
            @error('to_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Escalation Date -->
        <div class="form-group">
            <label>Enter Escalation Date *</label>
            <input type="date" name="escalation_date" class="form-control" required>
            @error('escalation_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Escalation Percentage -->
        <div class="form-group">
            <label>Enter Escalation (%) *</label>
            <input type="number" name="escalation_percentage" class="form-control" placeholder="Enter Escalation (%)" required>
            @error('escalation_percentage')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Date of Commitment -->
        <div class="form-group">
            <label>Enter Date of Commitment *</label>
            <input type="date" name="commitment_date" class="form-control" required>
            @error('commitment_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Date of Contract -->
        <div class="form-group">
            <label>Enter Date of Contract *</label>
            <input type="date" name="contract_date" class="form-control" required>
            @error('contract_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Enter Remarks -->
        <div class="form-group">
            <label>Enter Remarks</label>
            <textarea name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
            @error('remarks')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Upload PDF -->
        <div class="form-group">
            <label>Upload PDF</label>
            <input type="file" name="pdf" class="form-control" accept="application/pdf">
        </div>

        <button type="submit" class="btn btn-success">Add Details</button>
    </form>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Leave License Entries</h1>

    <form action="{{ route('leave-license.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Enter Unit -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Unit *</label>
                <input type="text" name="unit" class="form-control" placeholder="Enter Unit" required>
                @error('unit')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Owner -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Owner *</label>
                <input type="text" name="owner" class="form-control" placeholder="Enter Owner" required>
                @error('owner')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Rent Amount -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Rent Amount *</label>
                <input type="number" name="rent_amount" class="form-control" placeholder="Enter Rent Amount" required>
                @error('rent_amount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Deposit Amount -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Deposit Amount *</label>
                <input type="number" name="deposit_amount" class="form-control" placeholder="Enter Deposit Amount" required>
                @error('deposit_amount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter From Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter From Date *</label>
                <input type="date" name="from_date" class="form-control" required>
                @error('from_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter To Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter To Date *</label>
                <input type="date" name="to_date" class="form-control" required>
                @error('to_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Escalation Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Escalation Date *</label>
                <input type="date" name="escalation_date" class="form-control" required>
                @error('escalation_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Escalation Percentage -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Escalation (%) *</label>
                <input type="number" name="escalation_percentage" class="form-control" placeholder="Enter Escalation (%)" required>
                @error('escalation_percentage')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Date of Commitment -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Date of Commitment *</label>
                <input type="date" name="commitment_date" class="form-control" required>
                @error('commitment_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Enter Date of Contract -->
            <div class="col-md-6 mb-3">
                <label class="form-label text-success">Enter Date of Contract *</label>
                <input type="date" name="contract_date" class="form-control" required>
                @error('contract_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Enter Remarks -->
            <div class="col-md-12 mb-3">
                <label class="form-label text-success">Enter Remarks</label>
                <textarea name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
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

        <button type="submit" class="btn btn-success">Add Details</button>
    </form>
</div>
@endsection



<script>
    $(document).ready(function(){
        $('input[type="date"]').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
</script>
