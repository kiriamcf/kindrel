<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreAnimalRequest $request)
    {
        //
    }

    public function show(Animal $animal)
    {
        //
    }

    public function edit(Animal $animal)
    {
        //
    }

    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        //
    }

    public function destroy(Animal $animal)
    {
        //
    }
}
