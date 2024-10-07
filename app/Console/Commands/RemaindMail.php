<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommitteeMeetings;
use App\Models\Members;
use App\Models\Committees;
use App\Models\Frequencies;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommitteeMeetingRemainderNotification;

class RemaindMail extends Command 
{
    protected $signature = 'remainder:mail';
    protected $description = 'Send remainder emails for upcoming committee meetings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
        $committee_meetings = CommitteeMeetings::where('date_of_remainder', '<=', now())->get();

        foreach ($committee_meetings as $meeting) {
            $committee = Committees::where('committe_id', $meeting->committe_id)->first();
          
            $meeting->committee_name = $committee ? $committee->committe_name : 'N/A';
            
            $frequency = Frequencies::where('frequency_id', $meeting->frequency_id)->first();
            $meeting->frequency_name = $frequency ? $frequency->frequency_name : 'N/A';


            $memberDetails = Members::whereIn('member_id', function($query) use ($meeting) {
                $query->select('member_id')
                      ->from('committee_meeting_members')
                      ->where('committee_meeting_id', $meeting->id);
            })->get(['member_name', 'member_email']);
            
                
            if ($memberDetails->count() > 0) {
                $emails = $memberDetails->pluck('member_email')->toArray();
                $names = $memberDetails->pluck('member_name')->toArray();
            
                Mail::to($emails)->send(new CommitteeMeetingRemainderNotification($meeting, $names));
            }
            
        }
    }
}
