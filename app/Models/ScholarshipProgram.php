<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'grant_amount',
        'slots',
        'deadline',
        'status'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }
}