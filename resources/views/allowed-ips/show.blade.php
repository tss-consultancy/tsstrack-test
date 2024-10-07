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
                        <a href="{{url('/allowed-ips/index')}}">Allowed IP</a>
                      </li>
                      <li class="breadcrumb-item active" >
                        <a  href="{{url()->current()}}">Show IP</a>
                      </li>
                    </ol>
                  </nav>
                </div>
                    <div class="card mt-5">
                        <div class="card-header">
                            IP Details
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                        
                        <tbody>
                            @if($ip)
                                <tr>
                                    <th >IP Address</th>
                                    <td>{{$ip->ipaddress}}</td>
                                </tr>
                                <tr>
                                    <th >City</th>
                                    <td>{{$ip->city}}</td>
                                </tr>
                                <tr>
                                    <th >Country</th>
                                    <td>{{$ip->country}}</td>
                                </tr>
                                <tr>
                                    <th >State</th>
                                    <td>{{$ip->state}}</td>
                                </tr>
                                <tr>
                                    <th >Area</th>
                                    <td>{{$ip->area}}</td>
                                </tr>
                                <tr>
                                    <th >Status</th>
                                    <td>{{$ip->status == 1 ? 'Active' : 'Inactive'}}</td>
                                </tr>
                                <tr>
                                    <th >Description</th>
                                    <td>{{$ip->description}}</td>
                                </tr>
                                
                                <tr>
                                    <th >Created At</th>
                                    <td>{{$ip->created_at}}</td>
                                </tr>
                                <tr>
                                    <th >Updated At</th>
                                    <td>{{$ip->updated_at}}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    

                                    <td>
                                    <div class="action ">
                                      <button class="edit border-0">
                                        <a title="Edit" href="{{url('allowed-ips/edit',['id'=>$ip->id])}}"><i class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i></a>
                                      </button>
                                      <button class="edit border-0">
                                        <a title="Delete" href="{{url('allowed-ips/delete',['id'=>$ip->id])}}" onclick = "return confirm('are you sure to delete');"><i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a>
                                      </button>
                                    </div>
                                    </td>
                    
                                    
                                </tr>
                            @else
                                <tr>
                                    <td>IP not found</td>
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