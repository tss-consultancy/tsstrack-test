<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommitteeMeetingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;
    public $member_name;
    public $members;

    /**
     * Create a new message instance.
     *
     * @param $meeting
     * @param $member_name
     * @param $members
     */
    public function __construct($meeting, $member_name, $members)
    {
        $this->meeting = $meeting;
        $this->member_name = $member_name;
        $this->members = $members;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Committee Meeting Notification')
                    ->view('emails.committee_meeting_notification')
                    ->with([
                        'meeting' => $this->meeting,
                        'member_name' => $this->member_name,
                        'members' => $this->members,
                    ]);
    }
}
