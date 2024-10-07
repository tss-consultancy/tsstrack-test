@extends('layouts.app')
@section('content')
<div class="container">
<div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h1>Add Committee</h1>
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
                        <a href="{{url('/committees/index')}}">Committee</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="{{url('/committees/create')}}">Add Committee</a>
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
                <form action="#", method="POST">
                  @csrf
                  <div class="row">
                    <!-- <div id="successAlert" class="success-alert alert-popup alertbtn alert-hide">
                      <div class="alert alert-display">
                        <p class="text-medium">User added successfully...</p>
                      </div>
                    </div> -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label>Committee Title</label>
                        <input type="text" name="title" placeholder="Enter Committee title" />
                        <span class="text-danger">
                          @error('title')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>FREQUENCY</label>
                        <select class="" name="frequency">
  
                          @foreach ($frequencies as $frequency)
                            <option value="{{$frequency->frequency_id}}">{{$frequency->frequency_name}}</option>
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
                      <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                        Add Committee
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end card -->
            </div>
</div>
@endsection