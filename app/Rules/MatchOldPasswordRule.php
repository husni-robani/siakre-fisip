<?php

namespace App\Rules;

use Auth;
use Hash;
use Illuminate\Contracts\Validation\Rule;

class MatchOldPasswordRule implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return Hash::check($value, Auth::user()->password);
    }

    public function message(): string
    {
        return ':attribute sama dengan password lama.';
    }
}
