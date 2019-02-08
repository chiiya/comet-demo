<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryRepository implements RepositoryContract
{
    use AddsEagerLoads;

    /** @var Country */
    protected $country;

    /**
     * CountryRepository constructor.
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Fetch a country by its id.
     *
     * @param string $id
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Country
     */
    public function get($id, array $parameters = []): Country
    {
        $query = $this->country->newQuery()->where('code', $id);

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Country::getRelationNames());
        }

        return $query->firstOrFail();
    }

    /**
     * Find a country by supplied parameters.
     *
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Country
     */
    public function find(array $parameters = []): Country
    {
        $query = $this->country->newQuery();

        return $query->firstOrFail();
    }

    /**
     * Get a list of all countries.
     *
     * @param array $parameters
     *
     * @return Collection|Country[]
     */
    public function index(array $parameters = [])
    {
        $query = $this->country->newQuery();

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Country::getRelationNames());
        }

        return $query->get();
    }

    /**
     * Create a new country instance and store it in database.
     *
     * @param array $attributes
     *
     * @return Country
     */
    public function create(array $attributes): Country
    {
        return $this->country->newQuery()->create($attributes);
    }

    /**
     * Delete a country from database.
     *
     * @param Model $model
     */
    public function delete(Model $model): void
    {
        $model->delete();
    }

    /**
     * Update an existing country in database.
     *
     * @param Country $model
     * @param array $attributes
     */
    public function update(Model $model, array $attributes): void
    {
        $model->fill($attributes);
        $model->save();

        if (isset($attributes['languages'])) {
            $model->languages()->sync($attributes['languages']);
        }
    }
}
