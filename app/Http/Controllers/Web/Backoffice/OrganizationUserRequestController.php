<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Backoffice;

use App\Actions\OrganizationUserRequest\ListRequests;
use App\Actions\OrganizationUserRequest\ListOrganizations;
use App\Actions\OrganizationUserRequest\RequestAccess;
use App\Actions\OrganizationUserRequest\UpdateRequestStatus;
use App\Enums\OrgRequestStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrganizationUserRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class OrganizationUserRequestController extends Controller
{
    public function index(ListOrganizations $action, #[CurrentUser] User $user): Response
    {
        $data = $action->execute($user);

        return Inertia::render('RequestOrganizationAccess', $data);
    }

    public function store(RequestAccess $action, Organization $organization, #[CurrentUser] User $user): RedirectResponse
    {
        try {
            $action->execute($organization, $user);
            return Redirect::back()->with('success', 'Your access request has been submitted.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    public function show(ListRequests $action, Organization $organization): Response
    {
        $data = $action->execute($organization);

        return Inertia::render('ManageOrganizationRequests', $data);
    }

    public function update(UpdateOrganizationUserRequest $request, UpdateRequestStatus $action, Organization $organization, User $user): RedirectResponse
    {
        $status = $request->validated('status');

        try {
            $action->execute($organization, $user, $status);

            $message = $status === OrgRequestStatus::APPROVED->value
                ? 'The user has been granted access to the organization.'
                : 'The user\'s access request has been rejected.';

            return Redirect::back()->with('success', $message);
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
