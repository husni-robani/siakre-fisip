<?php

namespace App\Models;

use App\Enums\TimelineStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\assertGreaterThanOrEqual;

class Timeline extends Model
{
    protected $fillable = [
        'user_id',
        'sub_id',
        'major_id',
        'operation',
        'content'
    ];

    protected $casts = [
        'operation' => TimelineStatus::class,
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function scopeBySub($query, string $sub_id)
    {
        return $query->where('sub_id', '=', $sub_id);
    }

    public function scopeByMajor($query, string $major_id)
    {
        return $query->where('major_id', '=', $major_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
