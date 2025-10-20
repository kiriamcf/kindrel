<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationUserController;
use App\Http\Middleware\Organization;
use Illuminate\Support\Facades\Route;

Route::name('backoffice.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('organizations', [OrganizationUserController::class, 'list'])->name('organizations.request');

    Route::middleware([Organization::class])->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
    });
});