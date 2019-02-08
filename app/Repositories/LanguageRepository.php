<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LanguageRepository implements RepositoryContract
{
    use AddsEagerLoads;

    /** @var Language */
    protected $language;

    /**
     * LanguageRepository constructor.
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * Fetch a language by its id.
     *
     * @param int   $id
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Language
     */
    public function get($id, array $parameters = []): Language
    {
        $query = $this->language->newQuery()->where('code', $id);

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Language::getRelationNames());
        }

        return $query->firstOrFail();
    }

    /**
     * Find a language by supplied parameters.
     *
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Language
     */
    public function find(array $parameters = []): Language
    {
        $query = $this->language->newQuery();

        return $query->firstOrFail();
    }

    /**
     * Get a list of all languages.
     *
     * @param array $parameters
     *
     * @return Collection|Language[]
     */
    public function index(array $parameters = [])
    {
        $query = $this->language->newQuery();

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Language::getRelationNames());
        }

        return $query->get();
    }

    /**
     * Create a new language instance and store it in database.
     *
     * @param array $attributes
     *
     * @return Language
     */
    public function create(array $attributes): Language
    {
        return $this->language->newQuery()->create($attributes);
    }

    /**
     * Delete a language from database.
     *
     * @param Model $model
     */
    public function delete(Model $model): void
    {
        $model->delete();
    }

    /**
     * Update an existing language in database.
     *
     * @param Model $model
     * @param array $attributes
     */
    public function update(Model $model, array $attributes): void
    {
        $model->fill($attributes);
        $model->save();
    }
}
