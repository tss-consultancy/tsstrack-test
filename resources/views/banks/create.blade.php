@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h1>Add Bank</h1>
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
                        <a href="{{url('/banks/index')}}">Bank</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="{{url('/banks/create')}}">Add bank</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
            <!-- end col -->

            <div>
              <div class="card-style settings-card-2 mb-30">
                <form action="{{url('/banks/create')}}", method="POST">
                  @csrf
                  <div class="row">
                    <!-- <div id="successAlert" class="success-alert alert-popup alertbtn alert-hide">
                      <div class="alert alert-display">
                        <p class="text-medium">User added successfully...</p>
                      </div>
                    </div> -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label>Bank Title</label>
                        <input type="text" name="banktitle" placeholder="Enter bank title" /><span class="text-danger">
                          @error('banktitle')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                        Add Bank
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
          </div>
</div>
@endsection