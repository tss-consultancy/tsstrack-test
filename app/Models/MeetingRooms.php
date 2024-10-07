<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRooms extends Model
{
    use HasFactory;
    protected $table='meeting_rooms';
    protected $primaryKey='id';
    public $timestamps = false;
}
