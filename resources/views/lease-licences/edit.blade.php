@extends('layouts.app')
@section('content')
<div class="container">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>Edit Lease Licence</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/lease-licences/index') }}">Lease Licences</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ url('/lease-licences/create') }}">Edit Lease Licence</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card-style settings-card-2 mb-30">
            <form action="#" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label>Enter Unit</label>
                            <input type="text" name="unit"  placeholder="Enter Unit"
                                value="{{ $lease->unit}}" />
                            <span class="text-danger">
                                @error('unit')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label>Enter Owner</label>
                            <input type="text" name="owner"  placeholder="Enter Owner"
                                value="{{ $lease->owner }}" />
                            <span class="text-danger">
                                @error('owner')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Rent Amount</label>
                            <input type="number" name="rent" placeholder="Enter Rent Amount" value="{{ $lease->rent }}" />
                            <span class="text-danger">
                                @error('rent')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Deposit Amount</label>
                            <input type="number" name="deposit" placeholder="Enter Deposit Amount" value="{{$lease->deposit }}" />
                            <span class="text-danger">
                                @error('deposit')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Enter From Date</label>
                            <input type="date" name="from_date" value="{{$lease->lease_start_date}}" required>
                            <span class="text-danger">
                                @error('from_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Enter To Date</label>
                            <input type="date" name="to_date" value="{{$lease->lease_end_date}}" required>
                            <span class="text-danger">
                                @error('to_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Enter Esculation Date</label>
                            <input type="date" name="escalation_date" value="{{$lease->escalation_date}}" required>
                            <span class="text-danger">
                                @error('escalation_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Esculation(%)</label>
                            <input type="number" name="escalation_rate" placeholder="Enter Escalation(%)" value="{{ $lease->escalation_percentage }}" />
                            <span class="text-danger">
                                @error('escalation_rate')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Enter Date Of Commitment</label>
                            <input type="date" name="commitment_date" value="{{$lease->date_of_commitment}}" required>
                            <span class="text-danger">
                                @error('commitment_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Enter Date Of Contract</label>
                            <input type="date" name="contract_date" value="{{$lease->date_of_contract}}" required>
                            <span class="text-danger">
                                @error('contract_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Remarks</label>
                            <input type="text" name="remarks" value="{{ $lease->remarks }}" />
                            <span class="text-danger">
                                @error('remarks')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                  

                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                            Update Lease Licence
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
