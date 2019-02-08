<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookRepository implements RepositoryContract
{
    use AddsEagerLoads;

    /** @var Book */
    protected $book;

    /**
     * BookRepository constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Fetch a book by its id.
     *
     * @param int   $id
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Book
     */
    public function get($id, array $parameters = []): Book
    {
        $query = $this->book->newQuery()->where('id', $id);

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Book::getRelationNames());
        }

        return $query->firstOrFail();
    }

    /**
     * Find a book by supplied parameters.
     *
     * @param array $parameters
     *
     * @throws ModelNotFoundException
     *
     * @return Book
     */
    public function find(array $parameters = []): Book
    {
        $query = $this->book->newQuery();

        return $query->firstOrFail();
    }

    /**
     * Get a list of all books.
     *
     * @param array $parameters
     *
     * @return Collection|Book[]
     */
    public function index(array $parameters = [])
    {
        $query = $this->book->newQuery();

        // Add eager loads
        if (isset($parameters['with'])) {
            $query = $this->addEagerLoads($query, $parameters['with'], Book::getRelationNames());
        }

        // Filter by book title
        if (isset($parameters['title'])) {
            $query = $query->where('title', $parameters['title']);
        }

        // Filter by book publisher
        if (isset($parameters['publisher'])) {
            $query = $query->where('publisher', $parameters['publisher']);
        }

        // Filter by book author
        if (isset($parameters['author'])) {
            $query = $query->where('author_id', $parameters['author']);
        }

        // Filter by book country
        if (isset($parameters['country'])) {
            $query = $query->where('country_code', $parameters['country']);
        }

        // Filter by book language
        if (isset($parameters['language'])) {
            $query = $query->where('language_code', $parameters['language']);
        }

        return $query->get();
    }

    /**
     * Create a new book instance and store it in database.
     *
     * @param array $attributes
     *
     * @return Book
     */
    public function create(array $attributes): Book
    {
        return $this->book->newQuery()->create($attributes);
    }

    /**
     * Delete a book from database.
     *
     * @param Model $model
     */
    public function delete(Model $model): void
    {
        $model->delete();
    }

    /**
     * Update an existing book in database.
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
