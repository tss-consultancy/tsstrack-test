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
                        <!-- <li class="breadcrumb-item">
                        <a href="{{url('/committee-meetings/index')}}">Master</a>
                      </li> -->
                        <li class="breadcrumb-item ">
                            <a href="{{url('/committee-meetings/index')}}">Committee Meetings</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{url()->current()}}">Show Committee Meetings</a>
                        </li>
                        <!-- <li class="breadcrumb-item">
                        <a href="{{url('/committee-meetings/edit/{id}')}}">Edit Committee Meetings</a>
                      </li> -->
                    </ol>
                </nav>
            </div>

            <div class="card mt-5">

                <div class="card-header">
                    Committee Meeting Details
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>

                        </thead>
                        <tbody>
                            @if($committee_meetings)

                            <tr>
                                <th>
                                    <h6>Committee Name</h6>
                                </th>
                                <td>

                                    {{ $committee_meetings->committee->committee_name }}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Date Of Notice</h6>
                                </th>
                                <td>{{ \Carbon\Carbon::parse($committee_meetings->date_of_notice)->format('d-m-Y')}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Date Of Meeting</h6>
                                </th>
                                <td>{{ \Carbon\Carbon::parse($committee_meetings->date_of_meeting)->format('d-m-Y')}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Meeting From</h6>
                                </th>
                                <td>{{\Carbon\Carbon::parse($committee_meetings->committee_meeting_start_time)->format('h:i A')}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Meeting To</h6>
                                </th>
                                <td>{{\Carbon\Carbon::parse($committee_meetings->committee_meeting_end_time)->format('h:i A')}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Meeting Room</h6>
                                </th>
                                <td> @if($committee_meetings->meetingroom)
                                    {{ $committee_meetings->meetingroom->meeting_room_name }}
                                    @else
                                    Not set
                                    @endif</td>
                            </tr>
                            <tr>
                                <th>
                                    <h6>Meeting Link</h6>
                                </th>
                                <td>
                                    @if(empty($committee_meetings->link))
                                    Not set
                                    @else
                                    <a target="_blank" href="{{$committee_meetings->link}}">Click Here To Join</a>
                                    @endif
                                </td>

                            </tr>
                            <th>
                                <h6>Minute </h6>
                            <td>
                                @if(empty($committee_meetings->minut))
                                Not set
                                @else
                                <a href="{{ url('uploads/' . basename($committee_meetings->minut)) }}" target="_blank"
                                    class="btn btn-primary">View</a>
                                @endif
                            </td>
                            </th>

                            <tr>
                                <th>
                                    <h6>Date Of Next Meeting</h6>
                                </th>
                                <td>
                                    @if(empty($committee_meetings->date_of_next_meeting)
                                    ||$committee_meetings->date_of_next_meeting == '01-Jan-1970')
                                    <button class="btn btn-primary edit border-0 mb-1">
                                        <a title="Update" class="text-light"
                                            href="{{ url('committee-meetings/create', ['id' => $committee_meetings->id]) }}">
                                            Update Next Meeting
                                        </a>
                                    </button>
                                    @else
                                    {{ $committee_meetings->date_of_next_meeting }}
                                    <button class="btn btn-primary edit border-0 mb-1">
                                        <a title="Update" class="text-light"
                                            href="{{ url('committee-meetings/create', ['id' => $committee_meetings->id]) }}">
                                            Update Next Meeting
                                        </a>
                                    </button>
                                    @endif
                                </td>


                            </tr>




                            <tr>
                                <th>
                                    <h6>Actions</h6>
                                </th>
                                <td>
                                    <div class="action ">
                                        <button class="edit border-0">
                                            <a title="Edit"
                                                href="{{url('committee-meetings/edit',['id'=>$committee_meetings->id])}}"><i
                                                    class="lni lni-pencil px-2 mx-1 py-2 text-light bg-success rounded"></i></a>
                                        </button>
                                        <button class="edit border-0">
                                            <a title="Delete"
                                                href="{{url('committee-meetings/delete',['id'=>$committee_meetings->id])}}"
                                                onclick="return confirm('are you sure to delete');"><i
                                                    class="lni lni-trash-can px-2 mx-1 py-2 text-light bg-danger rounded"></i></a>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>Committee Meeting not found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-11 ps-5">
            <div class="card mt-5">
                <div class="card-header">
                    Members List
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>
                                <h6>Select</h6>
                            </th>
                            <th>
                                <h6>Sr No.</h6>
                            </th>
                            <th>
                                <h6>Member Name</h6>
                            </th>
                            <th>
                                <h6>Member Email</h6>
                            </th>
                            <th>
                                <h6>Status</h6>
                            </th>
                            <th>
                                <h6>Remarks</h6>
                            </th>
                            <th>
                                <h6>Actions</h6>
                            </th>
                        </thead>
                        <tbody>
                            @foreach($committee_meeting_members as $value)
                            <tr>
                                <td>
                                    <input type="checkbox" class="member-checkbox" value="{{ $value->member_id }}">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->member->member_name ?? 'N/A' }}</td>
                                <td>{{ $value->member->member_email ?? 'N/A' }}</td>
                                <td>
                                    @if($value->status == 1)
                                    <span class="badge bg-success px-2 py-2">Present</span>
                                    @elseif(is_null($value->status))
                                    <span class="badge bg-secondary px-2 py-2">Not Set</span>
                                    @else
                                    <span class="badge bg-danger px-2 py-2">Absent</span>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null($value->remarks))
                                    <span class="badge bg-secondary px-2 py-2">Not Set</span>
                                    @else
                                    <span class="badge bg-secondary px-2 py-2">{{$value->remarks}}</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $value->id }}"
                                        {{ $isMeetingTime ? '' : 'disabled' }}>
                                        Update
                                    </button>

                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="updateModal{{ $value->id }}" tabindex="-1"
                                    aria-labelledby="updateModalLabel{{ $value->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel{{ $value->id }}">Update
                                                    Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ url('committee-meeting-members/update-attendance', ['id' => $value->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="status{{ $value->id }}"
                                                            class="form-label">Status</label>
                                                        <select class="form-select" id="status{{ $value->id }}"
                                                            name="status">
                                                            <option value="1"
                                                                {{ $value->status == 1 ? 'selected' : '' }}>Present
                                                            </option>
                                                            <option value="0"
                                                                {{ $value->status == 0 ? 'selected' : '' }}>Absent
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="remarks{{ $value->id }}"
                                                            class="form-label">Remarks</label>
                                                        <textarea class="form-control" id="remarks{{ $value->id }}"
                                                            name="remarks" rows="3">{{ $value->remarks }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary"
                                                        onclick="showLoader()">Save</button>
                                                    <div id="overlay12">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-secondary mx-1" id="sendMailBtn">
                        Send Mail
                    </button>
                    <div id="overlay" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('sendMailBtn').addEventListener('click', function() {
    var selectedMembers = [];
    document.querySelectorAll('.member-checkbox:checked').forEach(function(checkbox) {
        selectedMembers.push(checkbox.value);
    });

    if (selectedMembers.length > 0) {
        showLoader(); // Call showLoader to display the spinner and overlay

        fetch('{{ url("/send-mails") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                member_ids: selectedMembers,
                committee_id: {{ $committee_meetings->id }}
            })
        }).then(response => response.json())
        .then(data => {
            // Hide the loader when the request completes
            document.getElementById('overlay').style.display = 'none';

            if (data.success) {
                Swal.fire({
                    title: "Email Sent!",
                    text: "The email has been sent successfully.",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!"
                });
            }
        }).catch(error => {
            // Hide the loader in case of error
            document.getElementById('overlay').style.display = 'none';

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "An error occurred: " + error.message
            });
        });
    } else {
        Swal.fire({
            icon: "warning",
            title: "No Selection",
            text: "Please select at least one member to send the email."
        });
    }
});

function showLoader() {
    const overlay = document.getElementById('overlay');
    overlay.style.display = 'flex'; // Show overlay

    const loader = overlay.querySelector('.spinner-border');
    loader.style.display = 'block'; // Show loader
}
</script>



@endsection