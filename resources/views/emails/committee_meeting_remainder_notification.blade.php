<!DOCTYPE html>
<html>
<head>
    <title>Committee Meeting Remainder Notification</title>

</head>
<body>
    <div class="container">


<p>Hi Team,</p>
<p>This is the remainder mail !!!</p>
<p>Below is the invitation for the <strong>{{$meeting->committee->committe_name}}</strong> for your reference. Feel free to reach out to me in case of any queries.</p>

<p>Dear Members,</p>

<p>Greetings for the day!</p>

<p>As part of our ongoing commitment, I am thrilled to invite you to our upcoming Committee Meeting, which will be held on <strong>{{ $meeting->date_of_meeting }}</strong> from <strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $meeting->committee_meeting_start_time)->format('g:i') }}</strong> 
to 
<strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $meeting->committee_meeting_end_time)->format('g:i') }}</strong> 
 at <strong>Location {{$meeting->meetingroom->meeting_room_name}}</strong>.</p>

<p>To ensure that everyone can participate, the meeting will be hosted online through a virtual platform. You can join the meeting using the following link:</p>

<p><a href="{{$meeting->link}}">Meeting Link</a></p>

<p>If you have any questions or require further information, please do not hesitate to contact me.</p>

<p>I look forward to seeing you all at the meeting!</p>

<p>Best regards,</p>
<p>Your Organization</p>


    </div>
</body>
</html>
