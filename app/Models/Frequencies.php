<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequencies extends Model
{
    use HasFactory;
    protected $table = 'frequencies';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function committeeMeetings(){
        return $this->belongsto(Frequencies::class);
    }
}
