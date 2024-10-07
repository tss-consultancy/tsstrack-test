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
                        <a href="{{url('/meeting-rooms/index')}}">Meeting Room</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="{{url()->current()}}">Show Meeting Room</a>
                      </li>
                    </ol>
                  </nav>
                </div>
                    <div class="card mt-5">
                        <div class="card-header">
                            Meeting Room Details
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                        
                        <tbody>
                            @if($meeting_rooms)
                                <tr>
                                    <th >Meeting Room name</th>
                                    <td>{{$meeting_rooms->meeting_room_name}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    

                                    <td>
                                    <div class="action ">
                                      <button class="edit border-0">
                                        <a title="Edit" href="{{url('meeting-rooms/edit',['id'=>$meeting_rooms->id])}}"><i class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i></a>
                                      </button>
                                      <button class="edit border-0">
                                        <a title="Delete" href="{{url('meeting-rooms/delete',['id'=>$meeting_rooms->id])}}" onclick = "return confirm('are you sure to delete');"><i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a>
                                      </button>
                                    </div>
                                    </td>
                    
                                    
                                </tr>
                            @else
                                <tr>
                                    <td>Meeting Room not found</td>
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