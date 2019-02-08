<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorsIndexRequest;
use App\Http\Requests\AuthorsShowRequest;
use App\Http\Requests\AuthorsStoreRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    /** @var AuthorRepository */
    protected $authorRepository;

    /**
     * AuthorController constructor.
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * GET an overview of all authors, optionally filtered by parameters.
     *
     * @param AuthorsIndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(AuthorsIndexRequest $request): JsonResponse
    {
        return response()->json($this->authorRepository->index($request->getParameters()), 200);
    }

    /**
     * GET a specific author.
     *
     * @param AuthorsShowRequest $request
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function show(AuthorsShowRequest $request, $id): JsonResponse
    {
        return response()->json($this->authorRepository->get((int) $id, $request->getParameters()), 200);
    }

    /**
     * POST a new author in database.
     *
     * @param AuthorsStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(AuthorsStoreRequest $request): JsonResponse
    {
        return response()->json($this->authorRepository->create($request->all()), 201);
    }

    /**
     * PATCH an existing author in database.
     *
     * @param AuthorsStoreRequest $request
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function update(AuthorsStoreRequest $request, $id): JsonResponse
    {
        $author = $this->authorRepository->get((int) $id);
        $this->authorRepository->update($author, $request->all());
        return response()->json($author, 200);
    }

    /**
     * DELETE an existing author from database.
     *
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $author = $this->authorRepository->get((int) $id);
        $this->authorRepository->delete($author);
        return response()->json([], 204);
    }
}
