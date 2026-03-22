<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Backoffice\DashboardController;
use App\Http\Controllers\Web\Backoffice\OrganizationUserController;
use App\Http\Controllers\Web\Backoffice\OrganizationUserRequestController;
use App\Http\Middleware\Organization;
use Illuminate\Support\Facades\Route;

Route::prefix('backoffice')->name('backoffice.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('organizations', [OrganizationUserRequestController::class, 'index'])->name('organizations.list');
    Route::post('organizations/{organization}/request-access', [OrganizationUserRequestController::class, 'store'])->name('organizations.requestAccess');

    Route::middleware([Organization::class])->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        // TODO: Add middleware for organization access control
        Route::prefix('organizations/{organization}')->name('organization.')->group(function () {
            Route::prefix('manage')->name('manage.')->group(function () {
                Route::get('requests', [OrganizationUserRequestController::class, 'show'])->name('requests');
                Route::patch('requests/{user}', [OrganizationUserRequestController::class, 'update'])->name('requests.update');
                Route::get('users', [OrganizationUserController::class, 'index'])->name('users');
                Route::post('users', [OrganizationUserController::class, 'store'])->name('users.store');
                Route::patch('users/{user}', [OrganizationUserController::class, 'update'])->name('users.update');
                Route::delete('users/{user}', [OrganizationUserController::class, 'destroy'])->name('users.destroy');
            });
        });
    });
});
