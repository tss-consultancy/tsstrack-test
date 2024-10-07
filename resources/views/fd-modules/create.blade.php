@extends('layouts.app')
@section('content')
<div class="container">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>Add FD</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/dashboard') }}">Masters</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('/fd-modules/index') }}">FD Modules</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ url('/fd-modules/create') }}">Add FD</a>
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
                            <label>Select Bank</label>
                            <select class="" name="bank" style="width:100%">
                                @foreach($bank as $value)
                                    <option value="{{ $value->id }}" {{ old('bank') == $value->id ? 'selected' : '' }}>{{ $value->bank_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('bank')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter FD Date</label>
                            <input type="date" name="date_of_fd" value="{{ old('date_of_fd') }}" />
                            <span class="text-danger">
                                @error('date_of_fd')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter FD Number</label>
                            <input type="number" name="fdnumber" placeholder="Enter FD Number" value="{{ old('fdnumber') }}" />
                            <span class="text-danger">
                                @error('fdnumber')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}" />
                            <span class="text-danger">
                                @error('amount')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter ROI(%)</label>
                            <input type="number" name="roi" placeholder="Enter ROI(%)" value="{{ old('roi') }}" />
                            <span class="text-danger">
                                @error('roi')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>FREQUENCY</label>
                            <select class="" name="frequency" style="width: 100%">
                                @foreach ($frequencies as $frequency)
                                    <option value="{{ $frequency->id }}" {{ old('frequency') == $frequency->id ? 'selected' : '' }}>{{ $frequency->frequency_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('frequency')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter FD Maturity Date</label>
                            <input type="date" name="maturity_date" value="{{ old('maturity_date') }}" />
                            <span class="text-danger">
                                @error('maturity_date')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Remarks</label>
                            <input type="text" name="remarks" value="{{ old('remarks') }}" />
                            <span class="text-danger">
                                @error('remarks')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                            Add FD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
