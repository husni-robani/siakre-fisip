<?php

namespace App\Services;

use App\Models\Sub;
use Auth;

class SubService
{
    public function getSubByStandardId(string $standardId)
    {
        return Sub::with(['standard', 'documents'])
            ->where('standard_id', '=', $standardId)
            ->get();
    }

    public function getStandardSubByMajorId(string $standardId, string $majorId)
    {
        return Sub::with(['documents'])
            ->where('standard_id', '=', $standardId)
            ->whereHas('documents', fn($document) => $document->where('major_id', '=', $majorId))
            ->get();
    }
}
