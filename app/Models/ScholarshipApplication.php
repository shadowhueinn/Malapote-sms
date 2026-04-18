<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipApplication extends Model
{
    use HasFactory;

    protected $table = 'scholarship_applications';

    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'middle_name',
        'maiden_name',
        'birthdate',
        'sex',
        'civil_status',
        'contact_number',
        'email',
        'street',
        'barangay',
        'municipality',
        'province',
        'region',
        'school_id',
        'year_level',
        'tribal_membership',
        'father_name',
        'mother_name',
        'household_income',
        'is_indigent',
        'has_cor',
        'status',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'is_indigent' => 'boolean',
        'has_cor' => 'boolean',
        'household_income' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
