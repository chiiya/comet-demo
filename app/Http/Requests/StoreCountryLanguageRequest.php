<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'language_code' => 'required|exists:languages,code'
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
            'language_code.required' => 'Please specify a valid language code',
            'language_code.exists' => 'The specified language could not be found',
        ];
    }
}
