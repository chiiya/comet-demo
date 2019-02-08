<?php

namespace App\Http\Requests;

class BooksStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric',
            'author_id' => 'required|exists:authors,id',
            'country_code' => 'required|exists:countries,code',
            'language_code' => 'required|exists:languages,code',
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
            'title.required' => 'Please specify a book title',
            'description.required' => 'Please specify a description',
            'publisher.required' => 'Please specify a publisher',
            'price.required' => 'Please specify a price',
            'price.numeric' => 'The price must be a numeric value',
            'author_id.required' => 'Please specify an author',
            'author_id.exists' => 'The specified author could not be found',
            'country_code.required' => 'Please specify a country',
            'country_code.exists' => 'The specified country could not be found',
            'language_code.required' => 'Please specify a language',
            'language_code.exists' => 'The specified language could not be found',
        ];
    }
}
