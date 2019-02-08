<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountriesRequest;
use App\Http\Requests\CountriesStoreRequest;
use App\Repositories\CountryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /** @var CountryRepository */
    protected $countryRepository;

    /**
     * CountryController constructor.
     * @param CountryRepository $countryRepository
     */
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * GET an overview of all countries.
     *
     * @param CountriesRequest $request
     *
     * @return JsonResponse
     */
    public function index(CountriesRequest $request): JsonResponse
    {
        return response()->json($this->countryRepository->index($request->getParameters()), 200);
    }

    /**
     * GET a specific country.
     *
     * @param CountriesRequest $request
     * @param $code
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function show(CountriesRequest $request, $code): JsonResponse
    {
        return response()->json($this->countryRepository->get($code, $request->getParameters()), 200);
    }

    /**
     * POST a new country in database.
     *
     * @param CountriesStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(CountriesStoreRequest $request): JsonResponse
    {
        return response()->json($this->countryRepository->create($request->all()), 201);
    }

    /**
     * PATCH an existing country in database.
     *
     * @param CountriesStoreRequest $request
     * @param $code
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function update(CountriesStoreRequest $request, $code): JsonResponse
    {
        $country = $this->countryRepository->get($code);
        $this->countryRepository->update($country, $request->all());
        return response()->json($country, 200);
    }

    /**
     * DELETE an existing country from database.
     *
     * @param $code
     *
     * @throws ModelNotFoundException
     *
     * @return JsonResponse
     */
    public function delete($code): JsonResponse
    {
        $country = $this->countryRepository->get($code);
        $this->countryRepository->delete($country);
        return response()->json([], 204);
    }
}
