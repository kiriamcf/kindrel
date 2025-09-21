<?php

declare(strict_types=1);

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::resource('organization', OrganizationController::class, ['only' => ['index', 'show']]);
});
