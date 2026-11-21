<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $guarded = [];

    protected $casts = ['available' => 'boolean'];

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /** Filters: q (keyword), specialty (name), city, clinic (id). Empty values are ignored. */
    public function scopeFilter(Builder $query, array $f): Builder
    {
        return $query
            ->when($f['q'] ?? null, fn ($q, $v) => $q->where(fn ($q) => $q
                ->where('name', 'like', "%{$v}%")
                ->orWhereHas('clinic', fn ($c) => $c->where('name', 'like', "%{$v}%")->orWhere('city', 'like', "%{$v}%"))
                ->orWhereHas('specialty', fn ($s) => $s->where('name', 'like', "%{$v}%"))))
            ->when($f['specialty'] ?? null, fn ($q, $v) => $q->whereHas('specialty', fn ($s) => $s->where('name', $v)))
            ->when($f['city'] ?? null, fn ($q, $v) => $q->whereHas('clinic', fn ($c) => $c->where('city', $v)))
            ->when($f['clinic'] ?? null, fn ($q, $v) => $q->where('clinic_id', $v));
    }
}
