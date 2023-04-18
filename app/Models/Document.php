<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = [
        'sub_id',
        'user_id',
        'major_id',
        'status',
        'name',
        'file',
    ];

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function scopeVerified($query)
    {
        return $query->where('status', '=', 'Terverifikasi');
    }

    public function scopeNotVerified($query)
    {
        return $query->where('status', '!=', 'Terverifikasi');
    }

    public function scopeByMajorId($query, string $majorId)
    {
        return $query->where('major_id', '=', $majorId);
    }

    public function scopeInMajorIds($query, array $majorIds)
    {
        return $query->whereIn('major_id', $majorIds);
    }

    public function scopeBySubId($query, string $subId)
    {
        return $query->where('sub_id', '=', $subId);
    }

    public function scopeByStandardId($query, string $standardId)
    {
        return $query->whereHas('sub', fn($sub) => $sub->where('standard_id', '=', $standardId));
    }

    public function scopeInStandardIds($query, array $standardIds)
    {
        return $query->whereHas('sub', fn($sub) => $sub->whereIn('standard_id', $standardIds));
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class);
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }
}
