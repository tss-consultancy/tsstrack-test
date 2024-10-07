@extends('layouts.app')
@section('content')
<div class="container">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>Update FD</h1>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/dashboard')}}">Masters</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{url('/fd-modules/index')}}">FD Modules</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{url('/fd-modules/edit')}}">Update FD</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <div>
        <div class="card-style settings-card-2 mb-30">
            <form action="#" , method="POST">
                @csrf
                <div class="row">
                    <!-- <div id="successAlert" class="success-alert alert-popup alertbtn alert-hide">
                      <div class="alert alert-display">
                        <p class="text-medium">User added successfully...</p>
                      </div>
                    </div> -->
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label>Select Bank</label>
                            <select class="" name="bank" style="width:100%">
                        
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}"
                                    {{ $bank->id == old('bank', $fd->bank_id) ? 'selected' : '' }}>
                                    {{ $bank->bank_name }}
                                </option>
                                @endforeach
                              

                            </select>
                            <span class="text-danger">
                                @error('bank')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter FD Date</label>
                            <input type="date" name="date_of_fd" value="{{$fd->date_of_fd}}" />
                            <span class="text-danger">
                                @error('date_of_fd')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter FD Number</label>
                            <input type="number" name="fdnumber" placeholder="Enter FD Number"
                                value="{{$fd->fd_number}}" />
                            <span class="text-danger">
                                @error('fdnumber')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" value="{{$fd->amount}}" />
                            <span class="text-danger">
                                @error('amount')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter ROI(%)</label>
                            <input type="number" name="roi" placeholder="Enter ROI(%)"
                                value="{{$fd->rate_of_interest}}" />
                            <span class="text-danger">
                                @error('roi')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>FREQUENCY</label>
                            <select class="" name="frequency" style="width: 100%">
                                <!-- Show the selected frequency first -->


                                @foreach ($frequencies as $frequency)
                                <option value="{{ $frequency->id }}"
                                    {{ $frequency->id == old('frequency', $fd->frequency_id) ? 'selected' : '' }}>
                                    {{ $frequency->frequency_name }}
                                </option>
                                @endforeach
                            </select>

                            <span class="text-danger">
                                @error('frequency')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter FD Maturity Date</label>
                            <input type="date" name="maturity_date" value="{{$fd->date_of_maturity}}" />
                            <span class="text-danger">
                                @error('maturity_date')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Enter Remarks</label>
                            <input type="text" name="remarks" value="{{$fd->remarks}}" />
                            <span class="text-danger">
                                @error('remarks')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                            Updated FD
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end card -->
    </div>
</div>
@endsection