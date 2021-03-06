<?php

namespace App\Http\Requests;

class AuthorsShowRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * Get an array of request query parameters.
     *
     * @return array
     */
    public function getParameters(): array {
        return [
            'with' => $this->requestedRelations(),
        ];
    }
}
