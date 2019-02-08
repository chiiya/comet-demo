<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguagesRequest;
use App\Http\Requests\LanguagesStoreRequest;
use App\Repositories\LanguageRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /** @var LanguageRepository */
    protected $languageRepository;

    /**
     * LanguageController constructor.
     * @param LanguageRepository $languageRepository
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * GET an overview of all languages.
     *
     * @param LanguagesRequest $request
     *
     * @return JsonResponse
     */
    public function index(LanguagesRequest $request): JsonResponse
    {
        return response()->json($this->languageRepository->index($request->getParameters()), 200);
    }

    /**
     * GET a specific language.
     *
     * @param LanguagesRequest $request
     * @param $code
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function show(LanguagesRequest $request, $code): JsonResponse
    {
        return response()->json($this->languageRepository->get($code, $request->getParameters()), 200);
    }

    /**
     * POST a new language in database.
     *
     * @param LanguagesStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(LanguagesStoreRequest $request): JsonResponse
    {
        return response()->json($this->languageRepository->create($request->all()), 201);
    }

    /**
     * PATCH an existing language in database.
     *
     * @param LanguagesStoreRequest $request
     * @param $code
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function update(LanguagesStoreRequest $request, $code): JsonResponse
    {
        $language = $this->languageRepository->get($code);
        $this->languageRepository->update($language, $request->all());
        return response()->json($language, 200);
    }

    /**
     * DELETE an existing language from database.
     *
     * @param $code
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function delete($code): JsonResponse
    {
        $language = $this->languageRepository->get($code);
        $this->languageRepository->delete($language);
        return response()->json([], 204);
    }
}
