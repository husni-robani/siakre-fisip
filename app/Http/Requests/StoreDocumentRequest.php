<?php

namespace App\Http\Requests;

use App\Enums\StatusDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'standard_id' => ['required', 'exists:standards,id'],
            'sub_id' => ['required', 'exists:subs,id'],
            'user_name' => ['required'],
            'user_email' => ['required'],
            'major_id' => ['required', 'exists:majors,id'],
            'status' => ['required', new Enum(StatusDocument::class)],
            'name' => ['required'],
            'file' => ['required', 'file', 'mimes:pdf'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => request()->user()->id,
        ]);
    }


    public function authorize(): bool
    {
        return true;
    }
}
