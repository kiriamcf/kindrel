<?php

declare(strict_types=1);

use App\Http\Controllers\API\AnimalController;
use App\Http\Controllers\API\BreedController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\SpeciesController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::resource('organization', OrganizationController::class, ['only' => ['index', 'show']]);
    Route::resource('species', SpeciesController::class, ['only' => ['index', 'show']]);
    Route::resource('breed', BreedController::class, ['only' => ['index', 'show']]);
    Route::resource('animal', AnimalController::class, ['only' => ['index', 'show']]);
});
