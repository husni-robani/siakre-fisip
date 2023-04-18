<?php

namespace App\Services;

use App\Models\Major;

class MajorService
{
    public function getMajors()
    {
        return Major::with('users')
            ->get();
    }
}
