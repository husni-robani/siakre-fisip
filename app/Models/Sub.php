<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $fillable = [
        'standard_id',
        'name',
        'number',
        'description',
    ];

    public function scopeByMajor($query, string|number $majorId)
    {
        return $query->whereHas('documents', fn($document) => $document->where('major_id', '=', $majorId));
    }

    public function scopeByStandard($query, string $standardId)
    {
        return $query->where('standard_id', $standardId);
    }

    public function scopeHasDocument($query)
    {
        return $query->has('documents');
    }

    public function getRouteKeyName()
    {
        return 'number';
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class)->latest();
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class)->latest();
    }
}
