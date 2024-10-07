@extends('layouts.app')
@section('content')
<div class="container">
<div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h1>Add user</h1>
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
                        <a href="{{url('/users/index')}}">Users</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="{{url('/users/create')}}">Add user</a>
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
                <form action="{{url('/users/create')}}", method="POST">
                  @csrf
                  <div class="row">
                    <!-- <div id="successAlert" class="success-alert alert-popup alertbtn alert-hide">
                      <div class="alert alert-display">
                        <p class="text-medium">User added successfully...</p>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>User Name</label>
                        <input type="text" name="name" placeholder="Enter  your  full  Name" value="{{old('name')}}"/>
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
                        <input type="email" name="email" placeholder="Email" value="{{old('email')}}"/>
                        <span class="text-danger">
                              @error('email')
                              {{$message}}
                              @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" value="{{old('password')}}"/>
                        <span class="text-danger">
                              @error('password')
                              {{$message}}
                              @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-style-1">
                        <label>Phone No.</label>
                        <input type="number" name="phone_no" placeholder="Phone No." />
                        <span class="text-danger">
                              @error('phone_no')
                              {{$message}}
                              @enderror
                        </span>
                      </div>  
                    </div>

                    <!-- <div class="col-12">
                      <div class="input-style-1">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter  your  Password" />
                      </div> 
                    </div> -->
       
                    <div class="col-12">
                      <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                        Add user
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