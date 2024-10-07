<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommitteeMeetingRemainderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;
    public $memberNames;

    public function __construct($meeting, $memberNames)
    {
        $this->meeting = $meeting;
        $this->memberNames = $memberNames; 
    }
    

    public function build()
    {
        return $this->subject('Committee Meeting Remainder Notification')
            ->view('emails.committee_meeting_remainder_notification')
            ->with([
                'meeting' => $this->meeting,
                'members' => $this->memberNames, 
            ]);

    }
}

