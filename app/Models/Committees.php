<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committees extends Model
{
    use HasFactory;
    protected $table = 'committees';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function committeeMeetings(){
        return $this->hasMany(Committees::class,'id','id');
    }
    public function frequencies(){
        return $this->belongsto(Frequencies::class,'id','id');
    }
}
