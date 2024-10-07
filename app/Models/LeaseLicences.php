<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseLicences extends Model
{
    use HasFactory;
    protected $table = 'leaselicenceentry';
    protected $primarykey = 'id';
    public $timestamps = true;
}
