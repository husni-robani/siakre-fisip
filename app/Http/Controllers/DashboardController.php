<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Major;
use App\Models\Standard;
use App\Models\Sub;
use App\Models\User;
use App\Traits\HasMappingSelectOption;
use Inertia\Inertia;

class DashboardController extends Controller
{
    use HasMappingSelectOption;

    public function __invoke()
    {
        $count = [
            'user' => User::count(),
            'document' => Document::verified()->count(),
            'standard' => Standard::count(),
            'sub' => Sub::count(),
        ];

        $documents = Document::query()
            ->with(['user', 'sub', 'major'])
            ->when(request()->input('majorId'), fn($major, $array) => $major->inMajorIds($array))
            ->when(request()->input('standardId'), fn($standard, $array) => $standard->inStandardIds($array))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $majors = $this->mapToOptions(Major::all());
        $standards = $this->mapToOptions(Standard::all());

        $filters = [
            'majors' => $majors,
            'standards' => $standards,
            'majorIds' => request()->input('majorId')
                ? request()->input('majorId')
                : [],
            'standardIds' => request()->input('standardId')
                ? request()->input('standardId')
                : [],

        ];

        return Inertia::render('Index', compact('count', 'documents', 'filters'));
    }
}
