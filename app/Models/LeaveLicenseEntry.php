<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveLicenseEntry extends Model
{
    use HasFactory;

    // Define your fillable or guarded properties
    protected $fillable = [
        'unit',
        'owner',
        'rent_amount',
        'deposit_amount',
        'from_date',
        'to_date',
        'escalation_date',
        'escalation_percentage',
        'date_of_commitment',
        'date_of_contract',
        'remarks',
        'pdf_path', // If you're uploading PDFs
    ];
}
