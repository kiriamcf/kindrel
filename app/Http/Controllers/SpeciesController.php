<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Http\Resources\SpeciesResource;
use App\Models\Species;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class SpeciesController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SpeciesResource::collection(Species::paginate(100));
    }

    public function create()
    {
        //
    }

    public function store(StoreSpeciesRequest $request): SpeciesResource
    {
        $species = Species::create($request->validated());

        return SpeciesResource::make($species);
    }

    public function show(Species $species): SpeciesResource
    {
        return SpeciesResource::make($species);
    }

    public function edit(Species $species)
    {
        //
    }

    public function update(UpdateSpeciesRequest $request, Species $species): HttpResponse
    {
        $species->update($request->validated());

        return Response::noContent();
    }

    public function destroy(Species $species): HttpResponse
    {
        $species->delete();

        return Response::noContent();
    }

    public function list()
    {
        //
    }
}
