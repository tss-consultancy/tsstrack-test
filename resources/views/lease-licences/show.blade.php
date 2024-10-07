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
                        <a href="{{url('/lease-licenses/index')}}">Lease Licences Modules</a>
                      </li>
                      <li class="breadcrumb-item active" >
                        <a  href="{{url()->current()}}">Show Lease Licence</a>
                      </li>
                    </ol>
                  </nav>
                </div>
                    <div class="card mt-5">
                        <div class="card-header">
                        Lease Licence Details
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                        
                        <tbody>
                            @if($lease)
                                <tr>
                                    <th >UNIT</th>
                                    <td>{{$lease->unit}}</td>
                                </tr>
                                <tr>
                                    <th >OWNER</th>
                                    <td>{{$lease->owner}}</td>
                                </tr>
                                <tr>
                                    <th >RENT AMOUNT</th>
                                    <td>{{$lease->rent}}</td>
                                </tr>
                                <tr>
                                    <th >DEPOSIT AMOUNT</th>
                                    <td>{{$lease->deposit}}</td>
                                </tr>
                                <tr>
                                    <th >ESCALATION PERCENTAGE</th>
                                    <td>{{$lease->escalation_percentage}}</td>
                                </tr>
                                <tr>
                                    <th >ESCALATION AMOUNT</th>
                                    <td>{{$lease->escalation_amount}}</td>
                                </tr>
                                <tr>
                                    <th >LEASE START DATE</th>
                                    <td>{{$lease->lease_start_date}}</td>
                                </tr>
                                <tr>
                                    <th >LEASE END DATE</th>
                                    <td>{{$lease->lease_end_date}}</td>
                                </tr>
                                <tr>
                                    <th >ESCALATION DATE</th>
                                    <td>{{$lease->escalation_date}}</td>
                                </tr>
                                <tr>
                                    <th > DATE OF COMMITMENT</th>
                                    <td>{{$lease->escalation_date}}</td>
                                </tr>
                                <tr>
                                    <th > DATE OF CONTRACT</th>
                                    <td>{{$lease->escalation_date}}</td>
                                </tr>
                                <tr>
                                    <th > REMARKS</th>
                                    <td>{{$lease->remarks}}</td>
                                </tr>
                                <tr>
                                    <th > FILE</th>
                                    <td>{{is_null($lease->file)? 'File not uploaded' : $lease->file}}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    

                                    <td>
                                    <div class="action ">
                                      <button class="edit border-0">
                                        <a title="Edit" href="{{url('lease-licences/edit',['id'=>$lease->id])}}"><i class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i></a>
                                      </button>
                                      <button class="edit border-0">
                                        <a title="Delete" href="{{url('lease-licences/delete',['id'=>$lease->id])}}" onclick = "return confirm('are you sure to delete');"><i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a>
                                      </button>
                                    </div>
                                    </td>
                    
                                    
                                </tr>
                            @else
                                <tr>
                                    <td>lease licence not found</td>
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