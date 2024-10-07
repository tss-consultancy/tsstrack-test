@extends('layouts.app')
@section('content')
@if(session('added'))
      
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('added')}}</strong>    
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session('deleted'))              
<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('deleted')}}</strong>    
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>           

@endif
<div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h1>FD Modules</h1>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">

                      <li class="breadcrumb-item active">
                        <a href="{{url('/fd-modules/index')}}">FD Modules</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          
              <div class="tables-wrapper">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                          <h6 class="mb-10">FD Modules Data</h6> <span>Total Amount : &#8377; {{number_format($total)}}</span> 
                        </div>
                        <div class="right">
                            <a href="{{url('fd-modules/create')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Add </a>
                            <a href="{{url('calculate-fd/calculate')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Calculate FD </a>
                        </div>
                      </div>
<div class="table-wrapper table-responsive">
                      <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>
                                <h6>Sr No.</h6>
                              </th>
                              <th>
                                <h6>BANK</h6>
                              </th>
                              <th>
                                <h6>DATE</h6>
                              </th>
                              <th>
                                <h6>FD NUMBER</h6>
                              </th>
                              <th>
                                <h6>AMOUNT</h6>
                              </th>
                              <th>
                                <h6>ROI</h6>
                              </th>
                              <th>
                                <h6>FREQUENCY</h6>
                              </th>
                              <th>
                                <h6>FD MATURITY DATE</h6>
                              </th>



                              <th>
                                <h6>ACTIONS</h6>
                              </th>

                            </tr>
                            <!-- end table row-->
                          </thead>
                          <tbody>
                            @foreach($fd as $key=>$value)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$value->banks->bank_name}}</td>
                             
                              <td>{{ \Carbon\Carbon::parse($value->date_of_fd)->format('d-m-Y')}}</td>
                              <td>{{$value->fd_number}}</td>
                              <td>{{number_format($value->amount)}}</td>
                              <td>{{$value->rate_of_interest}}%</td>
                              <td>{{$value->frequencies->frequency_name}}</td>
                              
                              <td>{{ \Carbon\Carbon::parse($value->date_of_maturity)->format('d-m-Y')}}</td>
                            
                            <td>
                                    <div class="action ">

                                    <button class="edit border-0">
                                        <a title="Show" href="{{url('fd-modules/show', ['id' => $value->id])}}"><i class="lni lni-eye px-2 mx-1 py-2 text-light bg-primary rounded"></i></a>
                                      </button>
                                      <button class="edit border-0">
                                        <a title="Edit" href="{{url('fd-modules/edit', ['id' => $value->id])}}"><i class="lni lni-pencil  px-2 mx-1 py-2 text-light bg-success rounded"></i></a>
                                      </button>
                                      
                                      <button class="edit border-0">
                                        <a title="Delete" href="{{url('fd-modules/delete', ['id' => $value->id])}}" onclick = "return confirm('are you sure to delete');"><i class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a>
                                      </button>
                                    </div>
                                  </td>
                            </tr>
                            @endforeach
                         
                            <!-- end table row -->
                          </tbody>
                        </table>
                        <!-- end table -->
                      </div>
@endsection