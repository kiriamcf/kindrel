<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\OrgRequestStatus;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class OrganizationUserController extends Controller
{
    public function list(#[CurrentUser] User $user): Response
    {
        $organizations = Organization::paginate(12);
        $alreadyRequested = OrganizationUserRequest::where('user_id', $user->id)
            ->pluck('organization_id')
            ->toArray();

        return Inertia::render('RequestOrganizationAccess', [
            'organizations' => $organizations,
            'alreadyRequested' => $alreadyRequested,
        ]);
    }

    public function requestAccess(Organization $organization, #[CurrentUser] User $user): RedirectResponse
    {
        $exists = OrganizationUserRequest::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($exists) {
            return Redirect::back()
                ->with('error', 'You have already requested access to this organization.');
        }

        $organization->requests()->attach($user->id, [
            'status' => OrgRequestStatus::PENDING->value,
        ]);

        return Redirect::back()
            ->with('success', 'Your access request has been submitted.');
    }
}
