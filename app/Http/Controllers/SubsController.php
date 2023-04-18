<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubRequest;
use App\Http\Requests\UpdateSubRequest;
use App\Models\Standard;
use App\Models\Sub;
use App\Traits\HasMappingSelectOption;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Request;

class SubsController extends Controller
{
    use HasMappingSelectOption;

    public function index()
    {
        $standards = $this->mapToOptions(Standard::all());

        $filters = [
            'standardId' => request()->has('standardId')
                ? request()->get('standardId')
                : $standards->first()['id']
        ];

        $subs = Sub::query()
            ->when(request()->input('standardId'), fn($query, $standardId) => $query->where('standard_id', $standardId))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Subs/Index', compact('subs', 'standards', 'filters'));
    }

    public function create()
    {
        $standards = $this->mapToOptions(Standard::all());

        return Inertia::render('Subs/Create', compact('standards'));
    }

    public function store()
    {
        Sub::create(request()->all());

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menambahkan sub baru ke dalam sistem.'
        ]);
    }

    public function edit(Sub $sub)
    {
        return Inertia::render('Subs/Edit', compact('sub'));
    }

    public function update(Sub $sub, UpdateSubRequest $request)
    {
        $sub->update($request->all());

        return \Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil melakukan update.'
        ]);
    }

    public function destroy(Sub $sub)
    {
        $this->authorize('delete', $sub);

        $sub->delete();

        return \Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menghapus sub.',
        ]);
    }
}
