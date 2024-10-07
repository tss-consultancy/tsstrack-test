@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h1>Add Member</h1>
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
                        <a href="{{url('/members/index')}}">Member</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="{{url('/members/create')}}">Add member</a>
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
                <form action="{{url('members/create')}}", method="POST">
                  @csrf
                  <div class="row">
                    <!-- <div id="successAlert" class="success-alert alert-popup alertbtn alert-hide">
                      <div class="alert alert-display">
                        <p class="text-medium">User added successfully...</p>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Member Full name</label>
                        <input type="text" name="name" placeholder="First name" />
                        <span class="text-danger">
                          @error('name')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" />
                        <span class="text-danger">
                          @error('email')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1 drop-1">
                        <label>Member Committee name</label>
                        <select class="form-select js-example-basic-multiple1" name="states[]" multiple="multiple" >
                          @foreach($committees as $committee)
                            <option value="{{$committee->committe_id}}">{{$committee->committe_name}}</option>
                        @endforeach 
                          
                        </select>
                        <span class="text-danger">
                          @error('states')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Contact</label>
                        <input type="number" name="contact" placeholder="Contact" />
                        <span class="text-danger">
                          @error('contact')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                    </div>
              
                    <div class="col-12">
                      <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                        Add member
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