<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorRepository implements RepositoryContract
{
    use AddsEagerLoads;

    /** @var Author */
    protected $author;

    /**
     * AuthorRepository constructor.
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * Fetch an author by their id.
     *
     * @param int   $id
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Author
     */
    public function get($id, array $parameters = []): Author
    {
        $query = $this->author->newQuery()->where('id', $id);

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Author::getRelationNames());
        }

        return $query->firstOrFail();
    }

    /**
     * Find an author by supplied parameters.
     *
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Author
     */
    public function find(array $parameters = []): Author
    {
        $query = $this->author->newQuery();

        return $query->firstOrFail();
    }

    /**
     * Get a list of all authors.
     *
     * @param array $parameters
     *
     * @return Collection|Author[]
     */
    public function index(array $parameters = [])
    {
        $query = $this->author->newQuery();

        // Add eager loads
//        if (isset($parameters['with'])) {
//            $query = $this->addEagerLoads($query, $parameters['with'], Author::getRelationNames());
//        }

        // Filter by author name
        if (isset($parameters['name'])) {
            $query = $query->where(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%'.$parameters['name'].'%');
        }

        return $query->get();
    }

    /**
     * Create a new author instance and store it in database.
     *
     * @param array $attributes
     *
     * @return Author
     */
    public function create(array $attributes): Author
    {
        if (isset($attributes['date_of_birth'])) {
            $attributes['date_of_birth'] = Carbon::parse($attributes['date_of_birth'])->format('Y-m-d');
        }
        return $this->author->newQuery()->create($attributes);
    }

    /**
     * Delete an author from database.
     *
     * @param Model $model
     */
    public function delete(Model $model): void
    {
        $model->delete();
    }

    /**
     * Update an existing author in database.
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
