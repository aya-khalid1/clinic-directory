<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = ['doctor_id', 'patient_name', 'phone', 'date', 'time_slot', 'notes', 'status'];

    protected $casts = ['date' => 'date'];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getReferenceAttribute(): string
    {
        return 'APT-'.(1000 + $this->id);
    }
}
