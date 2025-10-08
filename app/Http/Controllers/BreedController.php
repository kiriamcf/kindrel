<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreedRequest;
use App\Http\Requests\UpdateBreedRequest;
use App\Http\Resources\BreedResource;
use App\Models\Breed;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class BreedController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return BreedResource::collection(Breed::with('species')->paginate(100));
    }

    public function create()
    {
        //
    }

    public function store(StoreBreedRequest $request): BreedResource
    {
        $breed = Breed::create($request->validated());

        return BreedResource::make($breed);
    }

    public function show(Breed $breed): BreedResource
    {
        return BreedResource::make($breed);
    }

    public function edit(Breed $breed)
    {
        //
    }

    public function update(UpdateBreedRequest $request, Breed $breed): HttpResponse
    {
        $breed->update($request->validated());

        return Response::noContent();
    }

    public function destroy(Breed $breed): HttpResponse
    {
        $breed->delete();

        return Response::noContent();
    }

    public function list()
    {
        //
    }
}
