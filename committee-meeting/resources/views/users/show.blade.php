@extends('layouts.app')
@section('content')

<div class="container-fluid ps-0">
            <div class="row">
                <!-- 25% -->
    
                <!-- 75% -->
                
                <div class="col-md-11 ps-5">
                                
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
                        <a href="{{url()->current()}}">Show user</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              
                    <div class="card mt-5">
                        <div class="card-header">
                            Users Details
                        </div>
                        <div class="card-body">
                            
                        <table class="table table-striped table-bordered">
    <tbody>
        @if($user)
            <tr>
                <th>Name</th>
                <td>{{$user->user_name}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$user->user_email}}</td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>{{$user->user_mobile}}</td>
            </tr>
            <tr>
                <th>Actions</th>
                <td>
                    <div class="action">
                        <button  class="edit border-0"> 
                            <a title="Edit" href="{{url('users/edit', ['id' => $user->user_id])}}">
                                <i class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i>
                            </a>
                        </button>
                        <button class="edit border-0"> 
                            <a title="Delete" href="{{url('users/delete', ['id' => $user->user_id])}}" onclick="return confirm('Are you sure you want to delete this user?');">
                                <i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i>
                            </a>
                        </button>
                    </div>
                </td>
            </tr>
        @else
            <tr>
                <td>User not found</td>
            </tr>
        @endif
    </tbody>
</table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection