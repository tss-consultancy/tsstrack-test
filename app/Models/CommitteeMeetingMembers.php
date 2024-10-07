<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMeetingMembers extends Model
{
    use HasFactory;

    protected $table = 'committee_meeting_members';
    protected $primaryKey = 'id';
    public $timestamps = true; // Assuming timestamps are not used in this table

    // Member relationship
    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id', 'id');
    }

    // Committee Meeting relationship
    public function committeemeeting()
    {
        return $this->belongsTo(CommitteeMeetings::class, 'committee_meeting_id', 'id');
    }
}
