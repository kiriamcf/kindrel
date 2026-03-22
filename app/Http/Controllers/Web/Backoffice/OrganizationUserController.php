<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Backoffice;

use App\Enums\OrgRequestStatus;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class OrganizationUserController extends Controller
{
    public function list(#[CurrentUser] User $user): Response
    {
        $requests = OrganizationUserRequest::where('user_id', $user->id)
            ->get(['organization_id', 'status']);

        $granted = $requests->where('status', OrgRequestStatus::APPROVED->value)
            ->pluck('organization_id')
            ->toArray();

        $requested = $requests->where('status', OrgRequestStatus::PENDING->value)
            ->pluck('organization_id')
            ->toArray();

        $organizations = Organization::whereIntegerNotInRaw('id', $granted)
            ->paginate(12);

        return Inertia::render('RequestOrganizationAccess', [
            'organizations' => $organizations,
            'requested' => $requested,
        ]);
    }

    public function requestAccess(Organization $organization, #[CurrentUser] User $user): RedirectResponse
    {
        $exists = OrganizationUserRequest::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', OrgRequestStatus::PENDING->value)
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

    public function manageRequests(Organization $organization): Response
    {
        $requests = $organization->requests()
            ->withPivot('status')
            ->get()
            ->map(function (User $user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->pivot->status,
                    'created_at' => $user->pivot->created_at,
                    'updated_at' => $user->pivot->updated_at,
                ];
            });

        return Inertia::render('ManageOrganizationRequests', [
            'requests' => $requests,
        ]);
    }

    public function acceptRequest(Organization $organization, User $user): RedirectResponse
    {
        $request = OrganizationUserRequest::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', OrgRequestStatus::PENDING->value)
            ->first();

        if (!$request) {
            return Redirect::back()
                ->with('error', 'No pending request found for this user and organization.');
        }

        $request->update(['status' => OrgRequestStatus::APPROVED->value]);
        $organization->users()->attach($user->id);

        return Redirect::back()
            ->with('success', 'The user has been granted access to the organization.');
    }

    public function rejectRequest(Organization $organization, User $user): RedirectResponse
    {
        $request = OrganizationUserRequest::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', OrgRequestStatus::PENDING->value)
            ->first();

        if (!$request) {
            return Redirect::back()
                ->with('error', 'No pending request found for this user and organization.');
        }

        $request->update(['status' => OrgRequestStatus::REJECTED->value]);

        return Redirect::back()
            ->with('success', 'The user\'s access request has been rejected.');
    }
}
