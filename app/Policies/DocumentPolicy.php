<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('access documents');
    }

    public function view(User $user, Document $document): bool
    {
        dd($user->major_id === $document->major_id);

        if ($user->major_id === $document->major_id) {
            return true;
        }

        if ($document->user_id === $user->id) {
            return true;
        }

        return $user->can('access documents');
    }

    public function create(User $user): bool
    {
        return $user->can('store document');
    }

    public function update(User $user, Document $document): bool
    {
        return true;
    }

    public function delete(User $user, Document $document): bool
    {
        if ($user->id === $document->user_id) {
            return true;
        }

        return $user->can('delete document');
    }

    public function restore(User $user, Document $document): bool
    {
        return true;
    }

    public function forceDelete(User $user, Document $document): bool
    {
        if ($user->id === $document->user_id) {
            return true;
        }

        return true;
    }
}
