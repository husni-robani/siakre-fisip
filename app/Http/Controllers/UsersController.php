<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\User;
use App\Notifications\UserRegister;
use App\Notifications\UserRegisteredNotification;
use App\Traits\HasMappingSelectOption;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Str;

class UsersController extends Controller
{
    use HasMappingSelectOption;

    public function index()
    {
        $filters = [
            'keyword' => request()->has('keyword')
                ? request()->get('keyword')
                : '',
        ];

        $users = User::query()
            ->with(['major', 'roles'])
            ->notMe()
            ->notAdmin()
            ->when(request()->input('keyword'), fn($query, $keyword) => $query->where('name', 'like', '%' . $keyword . '%'))
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'major_name' => $user->major ? $user->major->name : null,
                'roles' => $user->roles()->pluck('name'),
            ]);

        return Inertia::render('Users/Index', compact('users', 'filters'));
    }

    public function create()
    {
        $majors = $this->mapToOptions(Major::all());

        return Inertia::render('Users/Create', compact('majors'));
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'ends_with:@widyatama.ac.id', 'unique:users,email'],
            'major_id' => ['required', 'numeric'],
            'roles' => ['required', 'array']
        ]);

        $randomString = Str::random(8);
        $validated['password'] = Hash::make($randomString);

        if ($validated['major_id'] === 0) {
            $validated['major_id'] = null;
        }

        $newUser = User::create($validated);

        $newUser->assignRole($validated['roles']);

        $newUser->notify(new UserRegister($newUser, $randomString));

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menambahkan pengguna baru, data lengkap telah dikirimkan ke email pengguna.'
        ]);
    }

    public function destory(User $user)
    {
        $user->delete();

        return Redirect::route('dashboard')->with('flash', [
            'type' => 'success',
            'message' => 'Berhasil menghapus pengguna dari sistem',
        ]);
    }
}
