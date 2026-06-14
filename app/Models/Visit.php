<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'visited_at',
        'complaint',
        'treatment_plan',
        'investigation',
        'medication',
        'medical_history',
        'dental_history',
        'review',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
