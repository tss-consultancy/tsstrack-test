<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedIPs extends Model
{
    use HasFactory;
    protected $table = 'allowedip';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
