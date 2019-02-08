<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get all the relationships that the client wants.
     *
     * @return array
     */
    public function requestedRelations(): array
    {
        return $this->has('include') ? explode(',', $this->get('include', '')) : [];
    }
}
