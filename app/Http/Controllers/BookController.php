<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksIndexRequest;
use App\Http\Requests\BooksShowRequest;
use App\Http\Requests\BooksStoreRequest;
use App\Repositories\BookRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /** @var BookRepository */
    protected $bookRepository;

    /**
     * BookController constructor.
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * GET an overview of all books, optionally filtered by parameters.
     *
     * @param BooksIndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(BooksIndexRequest $request): JsonResponse
    {
        return response()->json($this->bookRepository->index($request->getParameters()), 200);
    }

    /**
     * GET a specific book.
     *
     * @param BooksShowRequest $request
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function show(BooksShowRequest $request, $id): JsonResponse
    {
        return response()->json($this->bookRepository->get((int) $id, $request->getParameters()), 200);
    }

    /**
     * POST a new book in database.
     *
     * @param BooksStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(BooksStoreRequest $request): JsonResponse
    {
        return response()->json($this->bookRepository->create($request->all()), 201);
    }

    /**
     * PATCH an existing book in database.
     *
     * @param BooksStoreRequest $request
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function update(BooksStoreRequest $request, $id): JsonResponse
    {
        $book = $this->bookRepository->get((int) $id);
        $this->bookRepository->update($book, $request->all());
        return response()->json($book, 200);
    }

    /**
     * DELETE an existing book from database.
     *
     * @param $id
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $book = $this->bookRepository->get((int) $id);
        $this->bookRepository->delete($book);
        return response()->json([], 204);
    }
}
