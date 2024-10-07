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
                        <a href="{{url('/fd-modules/index')}}">FD Modules</a>
                      </li>
                      <li class="breadcrumb-item active" >
                        <a  href="{{url()->current()}}">Show FD</a>
                      </li>
                    </ol>
                  </nav>
                </div>
                    <div class="card mt-5">
                        <div class="card-header">
                            FD Details
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                        
                        <tbody>
                            @if($fd)
                                <tr>
                                    <th >Bank Name</th>
                                    <td>{{$fd->banks->bank_name}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >Date Of FD</th>
                                   
                                    <td> {{ \Carbon\Carbon::parse($fd->date_of_fd)->format('d-m-Y')}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >FD Number</th>
                                    <td>{{$fd->fd_number}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >Amount</th>
                                    <td>{{number_format($fd->amount)}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >Rate of Interest</th>
                                    <td>{{$fd->rate_of_interest }}%</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >Frequency</th>
                                    <td>{{$fd->frequencies->frequency_name}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >Date of Maturity</th>
                                   
                                    <td> {{ \Carbon\Carbon::parse($fd->date_of_maturity)->format('d-m-Y')}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th >Remarks</th>
                                    <td>{{$fd->remarks}}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    

                                    <td>
                                    <div class="action ">
                                      <button class="edit border-0">
                                        <a title="Edit" href="{{url('fd-modules/edit',['id'=>$fd->id])}}"><i class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i></a>
                                      </button>
                                      <button class="edit border-0">
                                        <a title="Delete" href="{{url('fd-modules/delete',['id'=>$fd->id])}}" onclick = "return confirm('are you sure to delete');"><i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a>
                                      </button>
                                    </div>
                                    </td>
                    
                                    
                                </tr>
                            @else
                                <tr>
                                    <td>FD not found</td>
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