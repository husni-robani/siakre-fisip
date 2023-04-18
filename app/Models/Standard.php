<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $fillable = [
        'name',
        'number',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'number';
    }


    public function subs()
    {
        return $this->hasMany(Sub::class);
    }
}
