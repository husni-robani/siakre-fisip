<?php

namespace App\Services;

use App\Models\Standard;
use Illuminate\Database\Eloquent\Collection;

class StandardService
{
    public function getStandards() : Collection
    {
        return Standard::with('subs')
            ->get();
    }
}
