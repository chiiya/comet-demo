<?php

namespace App\Http\Requests;

class AuthorsStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'last_name' => 'required',
            'first_name' => 'required',
            'date_of_birth' => 'date',
            'homepage' => 'url',
            'country_id' => 'exists:countries,id',
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
            'last_name.required' => 'Please specify the author\'s last name',
            'first_name.required' => 'Please specify the author\'s first name',
            'date_of_birth.date' => 'The date of birth must be a valid date',
            'homepage.url' => 'The homepage must be a valid URL',
            'country_id.exists' => 'The specified country could not be found',
        ];
    }
}
