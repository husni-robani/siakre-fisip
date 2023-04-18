<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use App\Traits\HasMappingSelectOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class StandardsController extends Controller
{
    public function index()
    {
        $standards = Standard::paginate(10);

        return Inertia::render('Standards/Index', compact('standards'));
    }

    public function create()
    {
        return Inertia::render('Standards/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'number' => ['required', 'unique:standards,number'],
            'description' => ['required', 'string'],
        ]);

        Standard::create($validated);

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menambahkan standar baru ke dalam sistem.'
        ]);
    }

    public function show(Standard $standard)
    {

    }

    public function edit(Standard $standard)
    {
        return Inertia::render('Standards/Edit', compact('standard'));
    }

    public function update(Request $request, Standard $standard)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'number' => ['required'],
            'description' => ['required', 'string'],
        ]);

        $standard->update($validated);

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil melakukan update standar.',
        ]);
    }

    public function destroy(Standard $standard)
    {
        $standard->delete();

        return \Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menghapus standar.'
        ]);
    }
}
