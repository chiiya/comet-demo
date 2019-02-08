<?php

namespace App\Http\Requests;

class LanguagesStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'code' => 'required|size:2',
            'name' => 'required',
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'code.required' => 'Please specify a language code',
            'code.size' => 'The language code must be exactly 2 characters long',
            'name.required' => 'Please specify a language name',
        ];
    }
}
