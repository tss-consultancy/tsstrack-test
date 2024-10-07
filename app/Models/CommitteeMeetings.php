<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMeetings extends Model
{
    use HasFactory;

    protected $table = 'committee_meetings';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Committee relationship
    public function committee()
    {
        return $this->belongsTo(Committees::class, 'committee_id', 'id');
    }

    // Meeting Room relationship
    public function meetingroom()
    {
        return $this->belongsTo(MeetingRooms::class, 'meeting_room_id', 'id');
    }

    // Members through pivot table
    public function members()
    {
        return $this->belongsToMany(Members::class, 'committee_meeting_members', 'committee_meeting_id', 'member_id');
    }

    // Committee meeting members relationship
    public function committeemembers()
    {
        return $this->hasMany(CommitteeMeetingMembers::class, 'committee_meeting_id', 'id');
    }
}
