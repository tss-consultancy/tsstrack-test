@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>Calculate FD Interest</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/fd-modules/index') }}">FD Modules</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Calculate FD Interest
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card-style settings-card-2 mb-30">
            <form action="{{ route('calculateInterest') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-style-1 drop-11">
                            <label>Select FD(s)</label>
                            <select class=""  id="fd-select" name="fd_ids[]" class="form-control" multiple="multiple" style="width:100%" required>
                                @foreach($fds as $fd)
                                    <option value="{{ $fd->id }}">{{$fd->banks->bank_name}} - {{$fd->fd_number}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('fd_ids')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Select Start Date</label>
                            <input type="date" name="start_date" required>
                            <span class="text-danger">
                                @error('start_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-style-1">
                            <label>Select End Date</label>
                            <input type="date" name="end_date" required>
                            <span class="text-danger">
                                @error('end_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="main-btn dark-btn btn-hover">Calculate Interest</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end card --> 
    </div>
</div>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#fd-select').select2({
        placeholder: "Select FD(s)",
        allowClear: true
    });
});
</script>

@endsection
