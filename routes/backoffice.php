<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationUserController;
use App\Http\Middleware\Organization;
use Illuminate\Support\Facades\Route;

Route::name('backoffice.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('organizations', [OrganizationUserController::class, 'list'])->name('organizations.list');
    Route::post('organizations/{organization}/request-access', [OrganizationUserController::class, 'requestAccess'])->name('organizations.requestAccess');

    Route::middleware([Organization::class])->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        // TODO: Add middleware for organization access control
        Route::prefix('organizations/{organization}')->name('organization.')->group(function () {
            Route::prefix('manage')->name('manage.')->group(function () {
                Route::get('requests', [OrganizationUserController::class, 'manageRequests'])->name('requests');
                Route::post('requests/{user}/accept', [OrganizationUserController::class, 'acceptRequest'])->name('requests.accept');
                Route::post('requests/{user}/reject', [OrganizationUserController::class, 'rejectRequest'])->name('requests.reject');
                Route::get('users', [OrganizationUserController::class, 'listUsers'])->name('users');
            });
            Route::get('requests', [OrganizationUserController::class, 'list'])->name('organizations.requests');
        });
    });
});
