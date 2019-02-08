<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Book.
 *
 * @mixin \App\Models\Book
 */

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'publisher' => $this->publisher,
            'price' => (float) $this->price,
            'author_id' => (int) $this->author_id,
            'country_code' => $this->country_code,
            'language_code' => $this->language_code,
        ];
    }
}
