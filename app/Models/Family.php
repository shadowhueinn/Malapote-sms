<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'father_name', 'father_status', 'father_address', 'father_occupation',
        'mother_name', 'mother_status', 'mother_address', 'mother_occupation',
        'total_parent_income', 'number_of_siblings'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
