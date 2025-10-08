<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Http\Resources\AnimalResource;
use App\Models\Animal;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class AnimalController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AnimalResource::collection(Animal::with('species')->paginate(100));
    }

    public function create()
    {
        //
    }

    public function store(StoreAnimalRequest $request): AnimalResource
    {
        $animal = Animal::create($request->validated());

        return AnimalResource::make($animal);
    }

    public function show(Animal $animal): AnimalResource
    {
        return AnimalResource::make($animal);
    }

    public function edit(Animal $animal)
    {
        //
    }

    public function update(UpdateAnimalRequest $request, Animal $animal): HttpResponse
    {
        $animal->update($request->validated());

        return Response::noContent();
    }

    public function destroy(Animal $animal): HttpResponse
    {
        $animal->delete();

        return Response::noContent();
    }

    public function list()
    {
        //
    }
}
