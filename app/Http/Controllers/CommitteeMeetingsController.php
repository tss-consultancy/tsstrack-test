<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CommitteeMeetings;
use App\Models\Members;
use App\Models\Committees;
use App\Models\Frequencies;
use App\Models\MeetingRooms;
use App\Models\CommitteeMeetingMembers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommitteeMeetingNotification;
use Redirect;
use Carbon\Carbon;


class CommitteeMeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
            $committee_meetings = CommitteeMeetings::with('meetingroom')->orderBy('date_of_meeting', 'desc')->get();
            
            return view('committee-meetings.index', compact('committee_meetings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
           
            
                $committees = Committees::all();
                $members = []; // Initially empty, will be populated based on AJAX request
                $meeting_rooms = MeetingRooms::all();
                $data = compact('members','committees','meeting_rooms');
                return view('committee-meetings.create')->with($data);
         
        
    }
    public function filterMembers(Request $request)
{
    $committeeId = $request->input('committee_id');
    dd($committeeId);

    // Get members based on the selected committee
    $members = Members::where('committee_id', $committeeId)->get(['id', 'member_name']);
    
    return response()->json($members);
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            //   session()->forget('login');
                $request->validate([
                    'cname' => 'required',
                    'date_of_notice' => 'required|date',
                    'date_of_meeting' => 'required|date',
                    'meeting_start_time' => 'required|date_format:H:i',
                    'meeting_end_time' => 'required|date_format:H:i|after:meeting_start_time',
                    'meeting_room' =>'required',
                    'states' => 'required|array',
                ]);
                $committee_meetings = new CommitteeMeetings;
                $committee_meetings->committee_id = $request['cname'];
                
                $committee_meetings->date_of_notice = $request['date_of_notice'];
                $committee_meetings->date_of_meeting = $request['date_of_meeting'];
                $checkid = $request['checkid'];
                if (!empty($checkid)) {
                    $committee_date_of_next_meeting = CommitteeMeetings::find($checkid);
                $committee_date_of_next_meeting->date_of_next_meeting = $request['date_of_meeting'];
                $committee_date_of_next_meeting->save();
                }
              
                
                $committee_meetings->committee_meeting_start_time = $request->meeting_start_time;
                $committee_meetings->committee_meeting_end_time = $request->meeting_end_time;
                $committee_meetings->meeting_room_id = $request['meeting_room'];
                $committee_meetings->link = $request['link'];
                $committee_meetings->save();
                foreach ($request['states'] as $member_id ) {
                    $committee_meeting_members = new CommitteeMeetingMembers;
                    $committee_meeting_members->committee_meeting_id = $committee_meetings->id;
                    $committee_meeting_members->member_id = $member_id;
                    $committee_meeting_members->save();
                }
                $members = Members::whereIn('id', $request['states'])->pluck('member_email')->toArray();
                session(['members' => $members]);
                $committee = Committees::where('id', $committee_meetings->committee_id)->first();
                if ($committee) {
                    $committee_meetings->committee_name = $committee->committee_name;
                } else {
                    $committee_meetings->committee_name = 'N/A'; 
                }
                // $frequencies = Frequencies::where('frequency_id',$committee_meetings->frequency_id)->first();
                // if ($frequencies) {
                //     $committee_meetings->frequency_name = $frequencies->frequency_name;
                // }else {
                //     $committee_meetings->frequency_name = 'N/A'; 
                // }
                    $meetingDetails = [
                        'meeting' => $committee_meetings,
                        'members' => Members::whereIn('id', $request['states'])->pluck('member_name')->toArray(),
                    ];
                   
                    Mail::send('emails.committee_meeting_notification', $meetingDetails, function ($message) use ($members) {
                        $message->to($members);
                        $message->subject('Committee Meeting Notification');
                    });
                return Redirect::to('/committee-meetings/index')->with('added','Committee Meeting added Successfully!');

        
        

    }
    public function updatedate($id){

                 $committees = Committees::all();
                $members = []; // Initially empty, will be populated based on AJAX request
                $meeting_rooms = MeetingRooms::all();
                $committee_meetings = CommitteeMeetings::find($id);
                // dd($committee_meetings->date_of_notice);
                $checkid = $id;
                $data = compact('members','committees','meeting_rooms','committee_meetings','checkid');
                return view('committee-meetings.create')->with($data);
    }
    public function updateminute(Request $request,$id){
        $request->validate([
            'min' => 'required|file|mimes:pdf,xls,xlsx,doc,docx|max:2048',
        ]);
        $committee_meetings = CommitteeMeetings::find($id);
         $committee_meetings->minute = $request['min'];
              
                if ($request->hasFile('min')) {
                    try {
                        $file = $request->file('min');
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->move(public_path('uploads'), $filename);
                        $committee_meetings->minute = 'uploads/' . $filename;
                        $committee_meetings->save();
                        return Redirect::to('/committee-meetings/index')->with('added','Minute added Successfully!');
                    } catch (\Exception $e) {
                        \Log::error('File upload error: ' . $e->getMessage());
                        return back()->withErrors(['min' => 'File upload failed.']);
                    }
                } else {
                    $committee_meetings->minute = ''; // Set default or leave null if field is nullable
                }

    }
public function sendMails(Request $request)
{
   
    $memberIds = $request->member_ids;
    
    $committeeMeetingId = $request->committee_id;

    // Retrieve email addresses for the selected members
    $member_emails = Members::whereIn('id', $memberIds)->pluck('member_email')->toArray();

    // Retrieve the committee meeting details
    $committee_meetings = CommitteeMeetings::find($committeeMeetingId);

    if (!$committee_meetings) {
        return response()->json(['success' => false, 'message' => 'Committee meeting not found'], 404);
    }

    // Retrieve additional committee and frequency details
    $committee = Committees::where('id', $committee_meetings->committee_id)->first();
    $committee_meetings->committee_name = $committee ? $committee->committee_name : 'N/A';

    // $frequencies = Frequencies::where('frequency_id', $committee_meetings->frequency_id)->first();
    // $committee_meetings->frequency_name = $frequencies ? $frequencies->frequency_name : 'N/A';

    // Prepare the meeting details for the email
    $meetingDetails = [
        'meeting' => $committee_meetings,
        'members' => Members::whereIn('id', $memberIds)->pluck('member_name')->toArray(),
    ];

    // Send emails to each selected member
    foreach ($member_emails as $email) {
        Mail::send('emails.committee_meeting_remainder_notification', $meetingDetails, function ($message) use ($email) {
            $message->to($email);
            $message->subject('Committee Meeting Notification');
        });
    }

    return response()->json(['success' => true, 'message' => 'Mails sent successfully!']);
}

    




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $committee_meetings = CommitteeMeetings::find($id);
    
        if (is_null($committee_meetings)) {
            return Redirect::to('/committee-meetings/index');
        } else {
            // Fetch committee meeting members with their associated member details
            $committee_meeting_members = CommitteeMeetingMembers::with('member')
                ->where('committee_meeting_id', $id)
                ->get();
    
            // Check if the current time is past the meeting time
            $currentDateTime = Carbon::now();
            $isMeetingTime = $currentDateTime->gte(Carbon::parse($committee_meetings->date_of_meeting));
    
            // Pass data to the view
            $data = compact('committee_meetings', 'committee_meeting_members', 'isMeetingTime');
            return view('committee-meetings.show')->with($data);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            
            $committee_meetings = CommitteeMeetings::find($id);
            // dd($committee_meetings);
            $meeting_rooms = MeetingRooms::all();
            if (is_null($committee_meetings)) {
                return Redirect::to('/committee-meetings/index');
            }else{
                $committees = Committees::where('id',$committee_meetings->committee_id)->get();
                if ($committees) {
                    foreach ($committees as $key ) {
                        $committee_meetings->committee_name = $key->committee_name;
                    }
                }
                $committee_names = Committees::all();
                $committee_meeting_members = CommitteeMeetingMembers::where('committee_meeting_id', $id)
                ->with('member')
                ->get();
            
            
                $selected_member_ids = $committee_meeting_members->pluck('member_id')->toArray();
                $member_names = Members::all();
                // $id_frequency = $committee_meetings->frequency_id;
                // $frequencies = Frequencies::where('frequency_id',$id_frequency)->get();
                // if ($frequencies) {
                //     foreach ($frequencies as $key ) {
                //         $committee_meetings->frequency_name = $key->frequency_name;
                //     }
                // }
                // $frequencies = Frequencies::all();
                $date_of_notice1 = Carbon::parse($committee_meetings->date_of_notice);
                $date_of_meeting1 = Carbon::parse($committee_meetings->date_of_meeting);
                // $date_of_remainder1 = Carbon::parse($committee_meetings->date_of_remainder);
                // $date_of_next_meeting1 = Carbon::parse($committee_meetings->date_of_next_meeting);
                $committee_meetings->date_of_notice1 = $date_of_notice1->format('Y-m-d');
                $committee_meetings->date_of_meeting1 = $date_of_meeting1->format('Y-m-d');
                // $committee_meetings->date_of_remainder1 = $date_of_remainder1->format('Y-m-d\TH:i:s');
                // $committee_meetings->date_of_next_meeting1 = $date_of_next_meeting1->format('Y-m-d\TH:i:s');
               
                $data = compact('committee_meetings', 'committee_names','selected_member_ids','member_names','committee_meeting_members','meeting_rooms');
                return view('committee-meetings.edit')->with($data);
           }
       
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
            $request->validate([
                'committees' => 'required',
                'date_of_notice' => 'required|date',
                'date_of_meeting' => 'required|date',
               
            ]);
    
            $committee_meetings = CommitteeMeetings::find($id);
    
            if (!$committee_meetings) {
                return back()->withErrors(['id' => 'Committee Meeting not found.']);
            }
    
            $committee_meetings->committee_id = $request['committees'];
            $committee_meetings->date_of_notice = $request['date_of_notice'];
            $committee_meetings->date_of_meeting = $request['date_of_meeting'];
            $committee_meetings->committee_meeting_start_time = $request->meeting_start_time;
            $committee_meetings->committee_meeting_end_time = $request->meeting_end_time;
            $committee_meetings->meeting_room_id = $request['meeting_room'];
            $committee_meetings->link = $request['link'];
            $committee_meetings->save();
                  
            $existing_member_ids = CommitteeMeetingMembers::where('committee_meeting_id', $committee_meetings->id)
            ->pluck('member_id')
            ->toArray();

   
            foreach ($request['states'] as $member_id) {
                if (!in_array($member_id, $existing_member_ids)) {
                    $committee_meeting_members = new CommitteeMeetingMembers;
                    $committee_meeting_members->committee_meeting_id = $committee_meetings->id;
                    $committee_meeting_members->member_id = $member_id;
                    $committee_meeting_members->save();
                }
            }

        
            CommitteeMeetingMembers::where('committee_meeting_id', $committee_meetings->id)
                ->whereNotIn('member_id', $request['states'])
                ->delete();
    
            $members = Members::whereIn('id', $request['states'])->pluck('member_email')->toArray();
                $committee = Committees::where('id', $committee_meetings->committee_id)->first();
                if ($committee) {
                    $committee_meetings->committee_name = $committee->committe_name;
                } else {
                    $committee_meetings->committee_name = 'N/A'; // If no committee is found
                }
                // $frequencies = Frequencies::where('frequency_id',$committee_meetings->frequency_id)->first();
                // if ($frequencies) {
                //     $committee_meetings->frequency_name = $frequencies->frequency_name;
                // }else {
                //     $committee_meetings->frequency_name = 'N/A'; // If no committee is found
                // }
                $meetingDetails = [
                    'meeting' => $committee_meetings,
                    'members' => Members::whereIn('id', $request['states'])->pluck('member_name')->toArray(),
                ];

                Mail::send('emails.committee_meeting_notification', $meetingDetails, function ($message) use ($members) {
                    $message->to($members);
                    $message->subject('Committee Meeting Notification');
                });
    
            return Redirect::to('/committee-meetings/index')->with('added', 'Committee Meeting updated successfully!');
       
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
            //   session()->forget('login');
            $committee_meeting_members = CommitteeMeetingMembers::where('committee_meeting_id',$id)->delete();

            $committee_meetings = CommitteeMeetings::find($id)->delete();
           
            return Redirect::to('/committee-meetings/index')->with('deleted', 'Committee Meeting deleted successfully!');
          
      
    }
    public function updateAttendance(Request $request, $id)
{
    
    $committeeMeetingMember = CommitteeMeetingMembers::find($id);

    if ($committeeMeetingMember) {
    
        $status = $request->input('status') === '1';
        $committeeMeetingMember->status = $status;
        $committeeMeetingMember->remarks = $request->input('remarks');
        $committeeMeetingMember->save();

        return redirect()->back()->with('success', 'Attendance status updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Member not found.');
    }
}
public function getMembers($committee_id)
{
    $members = Members::where('committee_id', $committee_id)->get();
   
    return response()->json($members)->header('Access-Control-Allow-Origin', '*');

}



    
}
  