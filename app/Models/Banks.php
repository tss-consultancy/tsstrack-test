<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;
    protected $table = 'banks';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
