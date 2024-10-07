@extends('layouts.app')
@section('content')
<?php $inc = 1;?>
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
                        <a href="{{url('/members/index')}}">Member</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="{{url()->current()}}">Show member</a>
                      </li>
                    </ol>
                  </nav>
                </div>
                    <div class="card mt-5">
                        
                        <div class="card-header">
                            Members Details
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                        <thead>
                            
                            
                            
                            
                        </thead>
                        <tbody>
                            @if($members)
                                <tr>
                                    <th>Name</th>
                                    <td>{{$members->member_name}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$members->member_email}}</td>
                                </tr>
                                <tr>
                                    <th>Committee Name</th>
                                    <td>{{$committees->committe_name}}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{$members->member_mobile}}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                    <div class="action ">
                                      <button  class="border-0"> 
                                      <a title="Edit" href="{{url('members/edit',['id'=>$members->member_id])}}"><i class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i></a></button>

                                    <button class="border-0"> 
                                    <a title="Delete" href="{{url('members/delete',['id'=>$members->member_id])}}" onclick = "return confirm('are you sure to delete');"><i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a></button>
                                  </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>Member not found</td>
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