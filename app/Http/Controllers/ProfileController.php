<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\User;
use App\Rules\MatchOldPasswordRule;
use App\Traits\HasMappingSelectOption;
use Auth;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function request;

class ProfileController extends Controller
{
    use HasMappingSelectOption;

    public function index()
    {
        $user = Auth::user();
        $majors = $this->mapToOptions(Major::all());

        return Inertia::render('Profile/Index', compact('user', 'majors'));
    }

    public function update()
    {
        $validated = request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'ends_with:@widyatama.ac.id', 'unique:users,email,' . Auth::user()->id],
            'major_id' => [''],
        ]);

        if ($validated['major_id'] === 0) {
            $validated['major_id'] = null;
        }

        Auth::user()->update($validated);

        return Redirect::back()->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil melakukan update profile'
        ]);
    }

    public function password()
    {
        $validated = request()->validate([
            'password' => ['required', new MatchOldPasswordRule],
            'newPassword' => ['required'],
            'confirmPassword' => ['same:newPassword'],
        ]);

        User::find(Auth::user()->id)
            ->update(['password' => Hash::make($validated['newPassword'])]);

        return Redirect::back()->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil melakukan update password',
        ]);
    }
}
