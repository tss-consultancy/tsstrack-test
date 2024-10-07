@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>Edit Committee Meetings</h1>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item">
                        <a href="{{url('/committee-meetings/index')}}">Master</a>
                      </li> -->
                            <li class="breadcrumb-item ">
                                <a href="{{url('/committee-meetings/index')}}">Committee Meetings</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{url()->current()}}">Edit Committee Meetings</a>
                            </li>
                            <!-- <li class="breadcrumb-item">
                        <a href="{{url('/committee-meetings/edit/{id}')}}">Edit Committee Meetings</a>
                      </li> -->
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
            <form action="#" , method="POST">
                @csrf
                <div class="row">
                    <!-- <div id="successAlert" class="success-alert alert-popup alertbtn alert-hide">
                      <div class="alert alert-display">
                        <p class="text-medium">User added successfully...</p>
                      </div>
                    </div> -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Committee Name</label>
                            <select class="" name="committees" id="committees" style="width:100%">



                                @foreach ($committee_names as $meeting)
                                <option value="{{ $meeting->committee_id }}"
                                    {{ $meeting->committee_id == old('committee_id', $committee_meetings->committee_id) ? 'selected' : '' }}>
                                    {{$meeting->committee_name}}
                                </option>
                                @endforeach


                            </select>
                            <span class="text-danger">
                                @error('committees')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>DATE OF NOTICE</label>
                            <input type="date" name="date_of_notice" placeholder="DATE OF NOTICE"
                                value="{{$committee_meetings->date_of_notice1}}" />
                            <span class="text-danger">
                                @error('date_of_notice')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>DATE OF MEETING</label>
                            <input type="date" name="date_of_meeting" placeholder="DATE OF MEETING"
                                value="{{$committee_meetings->date_of_meeting1}}" />
                            <span class="text-danger">
                                @error('date_of_meeting')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>MEETING START TIME</label>
                            <input type="time" name="meeting_start_time" placeholder="MEETING START TIME"
                                value="{{$committee_meetings->committee_meeting_start_time}}" />
                            <span class="text-danger">
                                @error('meeting_start_time')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-style-1">
                            <label>MEETING END TIME</label>
                            <input type="time" name="meeting_end_time" placeholder="MEETING END TIME"
                                value="{{$committee_meetings->committee_meeting_end_time}}" />
                            <span class="text-danger">
                                @error('meeting_end_time')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Meeting Room Name</label>
                            <select class="" name="meeting_room">
                                <option value="{{$committee_meetings->meeting_room_id}}" selected>
                                    {{ $committee_meetings->meetingRoom->meeting_room_name ?? 'Select a Room' }}
                                </option>
                                <!-- List other meeting rooms -->
                                @foreach ($meeting_rooms as $meeting_room)
                                @if ($meeting_room->id !== $committee_meetings->meeting_room_id)
                                <option value="{{ $meeting_room->id }}">
                                    {{ $meeting_room->meeting_room_name }}
                                </option>
                                @endif
                                @endforeach

                            </select>
                            <span class="text-danger">
                                @error('frequency')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>MEETING LINK</label>
                            <input type="text" name="link" placeholder="Enter Meeting Link"
                               value="{{$committee_meetings->link}}" />
                            <span class="text-danger">
                                @error('link')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1 drop-1">
                            <label>MEMBERS </label>
                            <select class="form-select js-example-basic-multiple" name="states[]" multiple="multiple"
                                id="members">

                                @foreach ($member_names as $member)
                <option value="{{ $member->id }}" 
                    {{ in_array($member->id, $selected_member_ids) ? 'selected' : '' }}>
                    {{ $member->member_name }}
                </option>
            @endforeach

                            </select>
                            <span class="text-danger">
                                @error('states')
                                {{$message}}
                                @enderror
                        </div>
                    </div>







                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                            Update Committee Meeting
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var committee_id = $('#committees').val();
    if (committee_id) {
        loadMembers(committee_id);
    }

    $('#committees').on('change', function() {
        var committee_id = $(this).val();
        if (committee_id) {
            loadMembers(committee_id);
        } else {
            $('#members').empty();
            $('#members').append('<option value="">Select Member</option>');
        }
    });
});

function loadMembers(committee_id) {
    var url = '{{ route("getMembers", ":id") }}';
    url = url.replace(':id', committee_id);
  
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#members').empty();
            $('#members').append('<option value="">Select Member</option>');
            $.each(data, function(key, member) {
                $('#members').append('<option value="' + member.id + '">' + member.member_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error);
        }
    });
}
</script>


@endsection