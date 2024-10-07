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
                    <h1>Committee Meetings</h1>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item">
                                <a href="{{url('/dashboard')}}">Master</a>
                            </li> -->
                            <li class="breadcrumb-item active">
                                <a href="{{url('/committee-meetings/index')}}">Committee Meetings</a>
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
                            <h6 class="mb-10">Committee Meetings Data</h6>
                        </div>
                        <div class="right">
                            <a href="{{url('committee-meetings/create')}}"
                                class="main-btn dark-btn rounded-full btn-hover master-btn">Add </a>
                        </div>
                    </div>


                    <div class=" table-wrapper table-responsive table ">
                        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <h6>Sr No</h6>
                                    </th>
                                    <th>
                                        <h6>Committee Name</h6>
                                    </th>
                                    <th>
                                        <h6>Date Of Notice</h6>
                                    </th>
                                    <th>
                                        <h6>Date Of Meeting</h6>
                                    </th>

                                    <th>
                                        <h6>Minute </h6>
                                    </th>

                                    <th>
                                        <h6>Date Of Next Meeting</h6>
                                    </th>


                                    <th>
                                        <h6>Actions</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                @foreach ($committee_meetings as $key => $meeting)
                                <tr>

                                    <td>{{$key + 1}}</td>

                                    <td class="wrap-text">
                                        {{ $meeting->committee->committe_name ?? 'N/A' }}
                                    </td>

                                    <td>{{$meeting->date_of_notice}}</td>
                                    <td>{{$meeting->date_of_meeting}}</td>
                                   
                                    <td>
                                        @if(empty($meeting->minut))
                                            Not set
                                        @else
                                        <a href="{{ url('uploads/' . basename($meeting->minut)) }}" target="_blank" class="btn btn-primary" >View</a>
                                        @endif
                                    </td>

                                    <td>
                                        @if(is_null($meeting->date_of_next_meeting) || $meeting->date_of_next_meeting
                                        ===
                                        '01-Jan-1970')
                                        Not Set
                                        @else
                                        <!-- \Carbon\Carbon::parse($committee_meetings->date_of_notice)->format('Y-m-d') -->
                                        {{ \Carbon\Carbon::parse($meeting->date_of_next_meeting)->format('d-M-Y') }}
                                        @endif
                                    </td>




                                    <td colspan=4>
                                        <div class="action ">
                                            <button class="edit border-0">
                                                <a title="Show"
                                                    href="{{url('committee-meetings/show',['id'=>$meeting->id])}}"><i
                                                        class="lni lni-eye px-2 mx-1  my-1 py-2 text-light bg-primary rounded"></i></a>
                                            </button>
                                            <button class="edit border-0">
                                                <a title="Edit"
                                                    href="{{url('committee-meetings/edit',['id'=>$meeting->id])}}"><i
                                                        class="lni lni-pencil px-2 mx-1 my-1 py-2 text-light bg-success rounded"></i></a>
                                            </button>

                                            <button class="edit border-0">
                                                <a title="Delete"
                                                    href="{{url('committee-meetings/delete',['id'=>$meeting->id])}}"
                                                    onclick="return confirm('are you sure to delete');"><i
                                                        class="lni lni-trash-can px-2 mx-1 my-1 py-2 text-light bg-danger rounded"></i></a>
                                            </button>
                                            <!-- <button class="btn btn-primary mb-2" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $meeting->id }}">
                                                <i class="bi bi-upload"></i>
                                            </button> -->
                                            <button class="edit border-0 " data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $meeting->id }}">
                                                <a title="Upload"
                                                    ><i
                                                        class="lni lni-upload px-2 mx-1  my-1 py-2 text-light bg-secondary rounded"></i></a>
                                            </button>


                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade  " id="updateModal{{ $meeting->id }}" tabindex="-1"
                                    aria-labelledby="updateModalLabel{{ $meeting->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-light">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel{{ $meeting->id }}">Update
                                                    Minute</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ url('committee-meetings/updateminute', ['id' => $meeting->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label> MINUTES </label>
                                                        <div class="form-group">
                                                            <input type="file" name="min" id="formFileSm" type="file"
                                                                accept=".pdf,.xls,xlsx,.doc,.docx"
                                                                >
                                                            @error('min')
                                                            {{$message}}
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end table row -->
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>

                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- End Col -->
    <!-- End Row -->
</div>

@endsection