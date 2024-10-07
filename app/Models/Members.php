<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Committee meetings (through pivot table)
    public function committeeMeetings()
    {
        return $this->belongsToMany(CommitteeMeetings::class, 'committee_meeting_members', 'member_id', 'committee_meeting_id');
    }
    public function committee(){
        return $this->belongsto(Committees::class);
    }
    
    // Committee meetings where the member was marked present
    public function presentCommitteeMeetings()
    {
        return $this->belongsToMany(CommitteeMeetings::class, 'committee_meeting_present_members', 'member_id', 'committee_meeting_id');
    }
}
