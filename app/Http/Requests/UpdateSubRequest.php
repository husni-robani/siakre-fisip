<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'number' => ['required'],
            'description' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
