<?php

namespace App\Http\Requests;

class AuthorsIndexRequest extends BaseRequest
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
     * List of allowed query parameter filters.
     *
     * @return array
     */
    protected function allowedFilters(): array
    {
        return [
            'name',
        ];
    }

    /**
     * Get an array of request query parameters.
     *
     * @return array
     */
    public function getParameters(): array {
        $parameters = [
            'with' => $this->requestedRelations(),
        ];

        foreach ($this->get('filter', []) as $key => $value) {
            if (\in_array($key, $this->allowedFilters(), true)) {
                $parameters[$key] = $value;
            }
        }

        return $parameters;
    }
}
