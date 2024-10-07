@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
                            <li class="breadcrumb-item">
                                <a href="{{url('/committee-meetings/index')}}">Committee Meeting</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{url('/committee-meetings/create')}}">Create Committee Meeting</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <div>
        <div class="card-style settings-card-2 mb-30">
            <form id="committeeMeetingForm" action="{{url('committee-meetings/create')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-style-1 drop-1">
                            <label>COMMITTEE </label>
                            <select class="form-select" name="cname" id="committees">
                                <option value="">Select Committee</option>
                                @foreach ($committees as $committee)
                                <option value="{{ $committee->id }}"
                                    {{ (isset($committee_meetings) && $committee_meetings->committee_id == $committee->id) ? 'selected' : '' }}>
                                    {{ $committee->committee_name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('cname')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    @if(isset($checkid) && !empty($checkid))
                    <input type="hidden" name="checkid" value="{{ $checkid }}">
                    @endif


                    <div class="col-12">
                        <div class="input-style-1">
                            <label>DATE OF NOTICE</label>
                            <input type="date" name="date_of_notice" placeholder="DATE OF NOTICE"
                                value="{{ isset($committee_meetings) ? \Carbon\Carbon::parse($committee_meetings->date_of_notice)->format('Y-m-d') : old('date_of_notice') }}" />
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
                                value="{{ isset($committee_meetings) ? \Carbon\Carbon::parse($committee_meetings->date_of_meeting)->format('Y-m-d') : old('date_of_meeting') }}" />
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
                                value="{{ isset($committee_meetings) ? \Carbon\Carbon::parse($committee_meetings->committee_meeting_start_time)->format('H:i') : old('meeting_start_time') }}" />
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
                                value="{{ isset($committee_meetings) ? \Carbon\Carbon::parse($committee_meetings->committee_meeting_end_time)->format('H:i') : old('meeting_end_time') }}" />
                            <span class="text-danger">
                                <span class="text-danger">
                                    @error('meeting_end_time')
                                    {{$message}}
                                    @enderror
                                </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Venue</label>
                            <select name="meeting_room" style="
    width: 100%;">
                                @foreach ($meeting_rooms as $meeting_room)
                                <option value="{{ $meeting_room->id }}"
                                    {{ (isset($committee_meetings) && $committee_meetings->meeting_room_id == $meeting_room->id) ? 'selected' : '' }}>
                                    {{ $meeting_room->meeting_room_name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('meeting_room')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>MEETING LINK</label>
                            <input type="text" name="link" placeholder="Enter Meeting Link" />
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

                            </select>
                            <span class="text-danger">
                                @error('states')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                            {{ isset($committee_meetings) ? 'Update Committee Meeting' : 'Add Committee Meeting' }}
                        </button>
                        <div id="overlay11" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<script>
$(document).ready(function() {
    $('#committeeMeetingForm').on('submit', function(e) {
        $('#overlay11').show();
    });

    $('#committees').on('change', function() {
        var committee_id = $(this).val();
        loadMembers(committee_id);
    });

    // If there's a default committee, load its members
    var initialCommitteeId = $('#committees').val();
    if (initialCommitteeId) {
        loadMembers(initialCommitteeId);
    }
});

function loadMembers(committee_id) {
    var url = '{{ route("getMembers", ":id") }}';
    url = url.replace(':id', committee_id);

    $.ajax({
        url: url,
        type: 'GET',    
    
        dataType: 'json',
        success: function(data) {
            $('#members').empty().append('<option value="">Select Member</option>');
            $.each(data, function(key, member) {
                $('#members').append('<option selected value="' + member.id + '">' + member
                    .member_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
            alert("An error occurred while loading members. Please try again.");
        }
    });
}
</script>

@endsection