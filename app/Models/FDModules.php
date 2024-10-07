<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FDModules extends Model
{
    use HasFactory;
    protected $table = 'fixed_deposits';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function getDateOfFdAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    
    public function getDateOfMaturityAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    public function frequencies(){
        return $this->belongsto(Frequencies::class,'frequency_id','id');
    }
    public function banks(){
        return $this->belongsto(Banks::class,'bank_id','id');
    }
    
}
