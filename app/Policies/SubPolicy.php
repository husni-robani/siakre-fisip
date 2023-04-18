<?php

namespace App\Policies;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('access subs');
    }

    public function view(User $user, Sub $sub): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Sub $sub): bool
    {
        return true;
    }

    public function delete(User $user, Sub $sub): bool
    {
        return $user->can('delete sub');
    }

    public function restore(User $user, Sub $sub): bool
    {
        return true;
    }

    public function forceDelete(User $user, Sub $sub): bool
    {
        return true;
    }
}
