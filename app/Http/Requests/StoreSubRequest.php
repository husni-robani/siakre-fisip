<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'standard_id' => ['required'],
            'name' => ['string', 'required'],
            'number' => ['required', 'unique:sub,number'],
            'description' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
