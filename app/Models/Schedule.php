<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $guarded = [];

    protected $casts = ['slots' => 'array'];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
